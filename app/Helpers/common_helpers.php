<?php

use App\Model\AccommodationApplicationType;
use App\Model\Area;
use App\Model\Constituency;
use App\Model\Designation;
use App\Model\District;
use App\Model\Division;
use App\Model\MenuPermission;
use App\Model\MenuRoute;
use App\Model\Ministry;
use App\Model\Parliament;
use App\Model\Profile;
use App\Model\ParliamentBillSubClause;
use App\Model\PoliticalParty;
use Illuminate\Support\Facades\Schema;

if (!function_exists('isApi')) {
    function isApi()
    {
        return Str::startsWith(request()->path(), 'api');
    }
}

if (!function_exists('accommodation_status')) {
    function accommodation_status($status)
    {
        if ($status == 0) {
            if (session()->get('language') == 'bn') {
                echo '<span class="badge badge-default">খসড়া</span>';
            } else {
                echo '<span class="badge badge-default">Draft</span>';
            }
        }

        if ($status == 1) {
            if (session()->get('language') == 'bn') {
                echo '<span class="badge badge-info">বিবেচনাধীন</span>';
            } else {
                echo '<span class="badge badge-info">Pending</span>';
            }
        }

        if ($status == 2) {
            if (session()->get('language') == 'bn') {
                echo '<span class="badge badge-success">এপ্রুভ (ডিপার্ট্মেন্ট)</span>';
            } else {
                echo '<span class="badge badge-success">Approved (Department)</span>';
            }
        }

        if ($status == 3) {
            if (session()->get('language') == 'bn') {
                echo '<span class="badge badge-danger">বাতিল (ডিপার্ট্মেন্ট) </span>';
            } else {
                echo '<span class="badge badge-danger">Reject (Department) </span>';
            }
        }

        if ($status == 4) {
            if (session()->get('language') == 'bn') {
                echo '<span class="badge badge-primary">এপ্রুভ (হুইপ) </span>';
            } else {
                echo '<span class="badge badge-primary">Approved (Whip) </span>';
            }
        }

        if ($status == 5) {
            if (session()->get('language') == 'bn') {
                echo '<span class="badge badge-danger">বাতিল (হুইপ) </span>';
            } else {
                echo '<span class="badge badge-danger">Reject (Whip) </span>';
            }
        }
    }
}

function bn2en($number)
{
    $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "AM", "PM", "am", "pm", "cusec", "litre", "horse", "Jan", "Feb", "Mar", "Apr", "May", "Jun", 'Jul', "Aug", "Sep", "Oct", "Nov", "Dec", "Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Weekend");
    $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এ.এম", "পি.এম", "এ.এম", "পি.এম", "কিউসেক", "লিটার/সে.", "অশ্বশক্তি", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "অগাস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর", "শনিবার", "রবিবার", "সোমবার", "মঙ্গলবার", "বুধবার", "বৃহস্পতিবার", "শুক্রবার", "সাপ্তাহিক ছুটি");
    return str_replace($bn, $en, $number);
}

function en2bn($number)
{
    $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "AM", "PM", "am", "pm", "cusec", "litre", "horse", "Jan", "Feb", "Mar", "Apr", "May", "Jun", 'Jul', "Aug", "Sep", "Oct", "Nov", "Dec", "Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Weekend", "দিন", "সপ্তাহ", "মাস", "বছর");
    $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এ.এম", "পি.এম", "এ.এম", "পি.এম", "কিউসেক", "লিটার/সে.", "অশ্বশক্তি", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "অগাস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর", "শনিবার", "রবিবার", "সোমবার", "মঙ্গলবার", "বুধবার", "বৃহস্পতিবার", "শুক্রবার", "সাপ্তাহিক ছুটি", "দিনের", "সপ্তাহের", "মাসের", "বছরের");
    return str_replace($en, $bn, $number);
}

function letteren2bn($number)
{
    $en = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13');
    $bn = array('ক', 'খ', 'গ', 'ঘ', 'ঙ', 'চ', 'ছ', 'জ', 'ঝ', 'ঞ', 'ট', 'ঠ', 'ড');
    return str_replace($en, $bn, $number);
}
if (!function_exists('userIdToProfileId')) {
    function userIdToProfileId()
    {
        // if (isApi()) {
        //     return auth('api')->user();
        // } else {
        //     return auth()->user();
        // }
        $profileInfo = Profile::where('user_id', authInfo()->id)->first();
            if ($profileInfo) {
                return $profileInfo->id;
            } else {
                return 0;
            }
    }
}

function userIdToProfileInfo($user_id)
{
    $profileInfo = Profile::where('user_id', $user_id)->first();
        if ($profileInfo) {
            return $profileInfo;
        } else {
            return false;
        }
}

if (!function_exists('authInfo')) {
    function authInfo()
    {
        if (isApi()) {
            return auth('api')->user();
        } else {
            return auth()->user();
        }
    }
}

// dont delete or edit this function anyone please
if (!function_exists('includeRouteFiles')) {

    if (!function_exists('getSubMenu')) {
        function getSubMenu($wheredata = ['parent' => null], $selected_sub_menu_id = null)
        {
            $sub_menus = App\Model\Menu::where('parent', $wheredata['parent'])->orderBy('sort', 'asc')->get();
            $html = '<option value="">Select Sub Menu</option>';
            foreach ($sub_menus as $key => $sub_menu) {
                if ($selected_sub_menu_id == $sub_menu->id) {
                    $select = 'selected';
                } else {
                    $select = '';
                }
                $html .= '<option value="' . $sub_menu['id'] . '" ' . @$select . '>' . $sub_menu['name'] . '</option>';
            }
            return $html;
        }
    }

    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('inner_permission')) {
    function inner_permission($permitted_route)
    {
        if (authInfo()->id == '1') {
            return true;
        }

        $user_role_array = authInfo()->user_role;
        if (count($user_role_array) == 0) {
            $user_role = [];
        } else {
            foreach ($user_role_array as $rolee) {
                $user_role[] = $rolee->role_id;
            }
        }

        $existpermission = MenuPermission::where('permitted_route', $permitted_route)->whereIn('role_id', @$user_role)->first();
        if ($existpermission) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('approvedStatus')) {
    function approvedStatus($value)
    {
        if ($value == 1) {
            $output = '<span class="badge badge-warning">' . __('Pending') . '</span>';
        } elseif ($value == 2) {
            $output = '<span class="badge badge-success">' . __('Approved') . '</span>';
        } elseif ($value == 3) {
            $output = '<span class="badge badge-danger">' . __('Rejected') . '</span>';
        } elseif ($value == 4) {
            $output = '<span class="badge badge-info">' . __('Acceptable') . '</span>';
        } elseif ($value == 5) {
            $output = '<span class="badge badge-primary">' . __('Acceptable with Correction') . '</span>';
        } else {
            $output = '<span class="badge badge-warning">' . __('Draft') . '</span>';
        }
        return $output;
    }
}

if (!function_exists('globalStatus')) {
    function globalStatus($type, $id)
    {
        $result = \DB::select("select * from global_status where status_type='" . $type . "' and status_id=" . $id);
        if (!empty($result)) {
            $output = '<span class="badge status_span badge-' . $result[0]->status_color . '">' . $result[0]->name_bn . '</span>';
        }

        return $output;
    }
}

if (!function_exists('sorpermission')) {
    function sorpermission($route)
    {
        $user_role_array = authInfo()->user_role;
        if (count($user_role_array) == 0) {
            $user_role = [];
        } else {
            foreach ($user_role_array as $rolee) {
                $user_role[] = $rolee->role_id;
            }
        }

        if (in_array(1, $user_role)) {
            return true;;
        } else {
            $mainmenuroute = MenuRoute::select('id')->where('route', $route)->first();
            if ($mainmenuroute != null) {
                $permission = MenuPermission::whereIn('role_id', $user_role)->where('permitted_route', $route)->first();
                if ($permission) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
    }
}

if (!function_exists('maritalStatusDropdown')) {
    function maritalStatusDropdown($editStatus = null)
    {
        $meritals = array(1 => Lang::get('Unmarried'), 2 => Lang::get('Married'), 3 => Lang::get('Divorced'), 4 => Lang::get('Widowed'));

        $html = '<option value="">' . __('Select Marital Status') . '</option>';
        foreach ($meritals as $key => $merital) {
            if ($editStatus == $key) {
                $selected = 'selected';
            } else {
                $selected = (old('merital_status') == $key) ? 'selected' : '';
            }
            $html .= '<option ' . $selected . ' value="' . $key . '">' . $merital . '</option>';
        }

        return $html;
    }
}

if (!function_exists('religionDropdown')) {
    function religionDropdown($editReligion = null)
    {
        $religions = array(1 => Lang::get('Islam'), 2 => Lang::get('Hindu'), 3 => Lang::get('Buddhist'), 4 => Lang::get('Christian'));
        $html = '<option value="">' . __('Select Religion') . '</option>';
        foreach ($religions as $key => $religion) {
            if ($editReligion == $key) {
                $selected = 'selected';
            } else {
                $selected = (old('religion') == $key) ? 'selected' : '';
            }
            $html .= '<option ' . $selected . ' value="' . $key . '">' . $religion . '</option>';
        }

        return $html;
    }
}

if (!function_exists('statusDropdown')) {
    function statusDropdown($editStatus = null)
    {
        $datas = ['0' => __('Pending'), '1' => __('Approved'), '2' => __('Rejected')];
        $html = '<option value="">' . __('Select Status') . '</option>';
        foreach ($datas as $key => $data) {
            if ($editStatus == $key) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $html .= '<option ' . $selected . ' value="' . $key . '">' . $data . '</option>';
        }
        return $html;
    }
}

if (!function_exists('activeStatusDropdown')) {
    function activeStatusDropdown($editStatus = null)
    {
        $datas = ['0' => __('Inactive'), '1' => __('Active')];
        $html = '<option value="">' . __('Select Status') . '</option>';
        foreach ($datas as $key => $data) {
            if ($editStatus == $key) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $html .= '<option ' . $selected . ' value="' . $key . '">' . $data . '</option>';
        }
        return $html;
    }
}

if (!function_exists('designationDropdown')) {
    function designationDropdown($selectedId = null)
    {
        if (Schema::hasTable('designations')) {
            $designations = Designation::all();
            if (isset($designations) && count($designations) > 0) {
                $output = '<option value="">' . __('Select Designation') . '</option>';
                foreach ($designations as $key => $designation) {
                    if ($selectedId && $selectedId == $designation->id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                        //$selected = (old('designation_id') == $key) ? 'selected' : '';
                    }
                    if (session()->get('language') == 'bn') {
                        $output .= '<option ' . $selected . ' value="' . $designation->id . '">' . $designation->name_bn . '</option>';
                    } else {
                        $output .= '<option ' . $selected . ' value="' . $designation->id . '">' . $designation->name . '</option>';
                    }
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}

if (!function_exists('ministryDropdown')) {
    function ministryDropdown($selectedId = null)
    {
        if (Schema::hasTable('ministries')) {
            $ministry_list = Ministry::all();
            if (isset($ministry_list) && count($ministry_list) > 0) {
                $output = '<option value="">' . __('Select Ministry') . '</option>';
                foreach ($ministry_list as $key => $list) {
                    if ($selectedId && $selectedId == $list->id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    if (session()->get('language') == 'bn') {
                        $output .= '<option ' . $selected . ' value="' . $list->id . '">' . $list->name_bn . '</option>';
                    } else {
                        $output .= '<option ' . $selected . ' value="' . $list->id . '">' . $list->name . '</option>';
                    }
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}

if (!function_exists('parliamentDropdown')) {
    function parliamentDropdown($selectedId = null)
    {
        if (Schema::hasTable('parliaments')) {
            $parliaments = Parliament::all();
            if (isset($parliaments) && count($parliaments) > 0) {
                $output = '<option value="">' . __('Select Parliament') . '</option>';
                foreach ($parliaments as $key => $parliament) {
                    if ($selectedId && $selectedId == $parliament->id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                        //$selected = (old('parliament_id') == $key) ? 'selected' : '';
                    }
                    $output .= '<option ' . $selected . ' value="' . $parliament->id . '">' . $parliament->parliament_number . '</option>';
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}

if (!function_exists('politicalPartiesDropdown')) {
    function politicalPartiesDropdown($selectedId = null)
    {
        if (Schema::hasTable('political_parties')) {
            $politicalParties = PoliticalParty::all();
            if (isset($politicalParties) && count($politicalParties) > 0) {
                $output = '<option value="">' . __('Select Political Party') . '</option>';
                foreach ($politicalParties as $key => $politicalParty) {
                    if ($selectedId && $selectedId == $politicalParty->id) {
                        $selected = 'selected';
                    } else {
                        $selected = (old('political_parties_id') == $key) ? 'selected' : '';
                    }
                    if (session()->get('language') == 'bn') {
                        $output .= '<option ' . $selected . ' value="' . $politicalParty->id . '">' . $politicalParty->name_bn . '</option>';
                    } else {
                        $output .= '<option ' . $selected . ' value="' . $politicalParty->id . '">' . $politicalParty->name . '</option>';
                    }
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}

if (!function_exists('divisionDropdown')) {
    function divisionDropdown($selectedId = null)
    {
        if (Schema::hasTable('divisions')) {
            $divisions = Division::all();
            if (isset($divisions) && count($divisions) > 0) {
                $output = '<option value="">' . __('Select Division') . '</option>';
                foreach ($divisions as $key => $division) {
                    if ($selectedId && $selectedId == $division->id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    if (session()->get('language') == 'bn') {
                        $output .= '<option ' . $selected . ' value="' . $division->id . '">' . $division->bn_name . '</option>';
                    } else {
                        $output .= '<option ' . $selected . ' value="' . $division->id . '">' . $division->name . '</option>';
                    }
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}
if (!function_exists('districtDropdown')) {
    function districtDropdown($selectedId = null)
    {
        if (Schema::hasTable('districts')) {
            $districts = District::all();
            if (isset($districts) && count($districts) > 0) {
                $output = '<option value="">' . __('Select District') . '</option>';
                foreach ($districts as $key => $district) {
                    if ($selectedId && $selectedId == $district->id) {
                        $selected = 'selected';
                    } else {
                        $selected = (old('birth_district_id') == $key) ? 'selected' : '';
                    }
                    if (session()->get('language') == 'bn') {
                        $output .= '<option ' . $selected . ' value="' . $district->id . '">' . $district->bn_name . '</option>';
                    } else {
                        $output .= '<option ' . $selected . ' value="' . $district->id . '">' . $district->name . '</option>';
                    }
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}

if (!function_exists('areaDropdown')) {
    function areaDropdown($selectedId = null)
    {
        if (Schema::hasTable('areas')) {
            $areas = Area::all();
            if (isset($areas) && count($areas) > 0) {
                $output = '<option value="">' . __('Select Area') . '</option>';
                foreach ($areas as $key => $area) {
                    if ($selectedId && $selectedId == $area->id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    if (session()->get('language') == 'bn') {
                        $output .= '<option ' . $selected . ' value="' . $area->id . '">' . $area->name_bn . '</option>';
                    } else {
                        $output .= '<option ' . $selected . ' value="' . $area->id . '">' . $area->name . '</option>';
                    }
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}

if (!function_exists('constituenciesDropdown')) {
    function constituenciesDropdown()
    {
        if (Schema::hasTable('constituencies')) {
            $constituencies = Constituency::all();
            if (isset($constituencies) && count($constituencies) > 0) {
                $output = '<option value="">' . __('Select Constituency') . '</option>';
                foreach ($constituencies as $key => $constituency) {
                    $selected = (old('constituency_id') == $key) ? 'selected' : '';
                    $output .= '<option value="' . $constituency->id . '"' . $selected . '>' . $constituency->name . '</option>';
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}
if (!function_exists('itemsDropdown')) {
    function itemsDropdown($type, $date = null, $ministry_id = null)
    {
        $output = '';
        if ($type == 'ministry') {
            $ministry_list = \DB::select("SELECT c.*,m.name_bn as ministry_name FROM circulars c left join ministries m on m.id = c.ministry_id where c.date='" . $date . "'");
            
            if (isApi()) {
                return $ministry_list;
            }
            if (isset($ministry_list) && count($ministry_list) > 0) {
                $output = '<option value="">' . __('Select Ministry') . '</option>';
                foreach ($ministry_list as $key => $m) {
                    $selected = (old('ministry_id') == $key) ? 'selected' : '';
                    $output .= '<option value="' . $m->ministry_id . '"' . $selected . '>' . $m->ministry_name . '</option>';
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
        }
        if ($type == 'wing') {
            $wing_list = \DB::select("SELECT m.*, mw.id as wing_id, mw.name_bn as wing_name FROM ministries m left join ministry_wings mw on m.id = mw.ministry_id where m.id=" . $ministry_id);
            
            if (isApi()) {
                return $wing_list;
            }
            if (isset($wing_list) && count($wing_list) > 0) {
                $output = '<option value="">' . __('Select Wing') . '</option>';
                foreach ($wing_list as $key => $m) {
                    $selected = (old('wing_id') == $key) ? 'selected' : '';
                    $output .= '<option value="' . $m->wing_id . '"' . $selected . '>' . $m->wing_name . '</option>';
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
        }
        return $output;
    }
}


if (!function_exists('activeStatus')) {
    function activeStatus($value)
    {
        if ($value == 1) {
            $output = '<span class="badge badge-success">' . __('Active') . '</span>';
        } else {
            $output = '<span class="badge badge-danger">' . __('Inactive') . '</span>';
        }
        return $output;
    }
}


if (!function_exists('OTPStatus')) {
    function OTPStatus($value)
    {
        if ($value == 1) {
            $output = '<span class="badge badge-success">' . __('Active') . '</span>';
        } else {
            $output = '<span class="badge badge-danger">' . __('Inactive') . '</span>';
        }
        return $output;
    }
}



if (!function_exists('digitDateLang')) {
    function digitDateLang($number)
    {
        $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "AM", "PM", "am", "pm", "January", "February", "March", "April", "May", "June", "July", "August", "Septempber", "October", "November", "December");
        $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এ.এম", "পি.এম", "এ.এম", "পি.এম", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর");

        if (Session::get('language') == 'bn') {
            return str_replace($en, $bn, $number);
        } else {
            return str_replace($bn, $en, $number);
        }
    }
}

if (!function_exists('nanoDateFormat')) {
    function nanoDateFormat($data, $format = null, $am_pm = false)
    {
        if ($data != '') {
            if ($am_pm) {
                return (!is_null($format)) ? date($format . ' | h:i A', strtotime($data)) : date('d F Y | h:i A', strtotime($data));
            } else {
                return (!is_null($format)) ? date($format, strtotime($data)) : date('d F Y', strtotime($data));
            }
        }
    }
}

if (!function_exists('statusDropdownView')) {
    function statusDropdownView($value)
    {
        if ($value == 0) {
            $output = '<span class="badge badge-warning">' . __('Pending') . '</span>';
        } elseif ($value == 1) {
            $output = '<span class="badge badge-success">' . __('Approved') . '</span>';
        } else {
            $output = '<span class="badge badge-danger">' . __('Rejected') . '</span>';
        }
        return $output;
    }
}


if (!function_exists('subClauseDropdown')) {
    function subClauseDropdown($id)
    {
        if (Schema::hasTable('parliament_bill_sub_clauses')) {
            $subClauses = ParliamentBillSubClause::where('parliament_bill_clause_id', $id)->get();
            if (isset($subClauses) && count($subClauses) > 0) {
                $output = '<option value="">' . __('Select Sub Clause') . '</option>';
                foreach ($subClauses as $key => $subClause) {
                    $output .= '<option value="' . $subClause->id . '">Sub clause - '  . $subClause->number . '</option>';
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}

if (!function_exists('billTopicList')) {
    function billTopicList($rule = null)
    {
        if (!is_null($rule) && $rule == 78) {
            return array(
                array('id' => '', 'name' => 'সংশোধনী উত্থাপন নির্বাচন করুন'),
                array('id' => 1, 'name' => Lang::get('Promoting Bills for Public Opinion')),
                array('id' => 2, 'name' => Lang::get('Sending Bills to the Standing/Assessment Committee')),
                array('id' => 3, 'name' => Lang::get('Adding Names to The Assessment Committee')),
                array('id' => 4, 'name' => Lang::get('Canceling Names from The Assessment Committee')),
                array('id' => 5, 'name' => Lang::get('Exchanging Names in The Assessment Committee'))
            );
        } else if (!is_null($rule) && $rule == 82) {
            return array(
                array('id' => '', 'name' => 'বিলের বিধানসমূহে সংশোধনীর নোটিশ নির্বাচন করুন'),
                array('id' => 1, 'name' => Lang::get('দফার পরিবর্তে দফা সন্নিবেশ')),
                array('id' => 2, 'name' => Lang::get('নতুন দফা সংযোজন')),
                array('id' => 3, 'name' => Lang::get('শর্ত-দফা সংযোজন')),
                array('id' => 4, 'name' => Lang::get('শব্দটি/শব্দাবলী বর্জন')),
                array('id' => 5, 'name' => Lang::get('শব্দাবলী সন্নিবেশ')),
                array('id' => 6, 'name' => Lang::get('প্যারার পরিবর্তে প্যারা সন্নিবেশ')),
                array('id' => 7, 'name' => Lang::get('শব্দাবলী বর্জন এবং শব্দাবলীর পরিবর্তে নতুন শব্দাবলী সন্নিবেশ'))
            );
        } else {
            return array();
        }
    }
}

if (!function_exists('comboList')) {
    function comboList($type = null, $rule_number = null)
    {
        $output = [];
        if (!is_null($type)) {
            if ($type === 'question_types') {
                if (!is_null($rule_number) && $rule_number == 42) {
                    $output = array(
                        array('id' => 0, 'name' => Lang::get('Non Star Question')),
                        array('id' => 1, 'name' => Lang::get('Star Question')),
                        array('id' => 2, 'name' => Lang::get('Prime Minister Question')),
                        //array('id' => 3, 'name' => Lang::get('Oral Question'))
                    );
                } else {
                    $output = array(
                        array('id' => 0, 'name' => Lang::get('Non Star Question')),
                        array('id' => 1, 'name' => Lang::get('Star Question'))
                    );
                }

                $output = array_sort($output, 'id', SORT_ASC);
            } else if ($type === 'parliament_sessions') {
                $output = array(
                    array('id' => 0, 'name' => Lang::get('Upcoming Session')),
                    array('id' => 1, 'name' => Lang::get('Current Session'))
                );
                $output = array_sort($output, 'id', SORT_DESC);
            } else if ($type === 'committee') {
                $output = array(
                    array('id' => '', 'name' => 'কমিটির নাম নির্বাচন করুন'),
                    array('id' => 1, 'name' => 'স্থায়ী কমিটি'),
                    array('id' => 2, 'name' => 'বাছাই কমিটি')
                );
                $output = array_sort($output, 'id', SORT_ASC);
            }
        }
        return $output;
    }
}

function array_sort($array, $on, $order = SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

if (!function_exists('csvToArray')) {
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}

if (!function_exists('accommodationApplicationTypeDropdown')) {
    function accommodationApplicationTypeDropdown($selectedId = null)
    {
        if (Schema::hasTable('accommodation_application_types')) {
            $acc_app_types = AccommodationApplicationType::all();
            if (isset($acc_app_types) && count($acc_app_types) > 0) {
                $output = '<option value="">' . __('Select AccommodationApplicationType') . '</option>';
                foreach ($acc_app_types as $key => $acc_app_type) {
                    if ($selectedId && $selectedId == $acc_app_type->id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $output .= '<option ' . $selected . ' value="' . $acc_app_type->id . '">' . $acc_app_type->type_name . '</option>';
                }
            } else {
                $output = '<option value="">' . __('No Data Available') . '</option>';
            }
            return $output;
        }
    }
}
