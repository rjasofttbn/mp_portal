<?php

namespace App\Http\Controllers\Backend\NoticeManagement;

use App\Http\Controllers\Controller;
use App\Model\AssessmentCommittee;
use App\Model\Cabinet;
use App\Model\Constituency;
use App\Model\Department;
use App\Model\Lotteries;
use App\Model\Lottery;
use App\Model\Ministry;
use App\Model\MinistryWings;
use App\Model\MpPs;
use App\Model\Notice;
use App\Model\NoticeAttachment;
use App\Model\NoticeConsent;
use App\Model\NoticeSpeech;
use App\Model\NoticeStage;
use App\Model\ParliamentBill;
use App\Model\ParliamentBillClause;
use App\Model\ParliamentBillSubClause;
use App\Model\ParliamentRule;
use App\Model\ParliamentSession;
use App\Model\Profile;
use App\Model\StandingCommittee;
use App\User;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use PDF;

class NoticeController extends Controller
{
    public function index($status_id = null)
    {

        $data['current_status_ids'] = (!is_null($status_id)) ? $status_id : 0;
        $data['allRules'] = ParliamentRule::orderBy('id', 'desc')->get();
        $user_type = authInfo()->usertype;
        $department_id = (authInfo()->department_id != '') ? Department::find(authInfo()->department_id)->department_no : 0;
        $data['user_type'] = $user_type;
        $data['parliamentSession'] = ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
        $declare_date = (!empty($data['parliamentSession'])) ? $data['parliamentSession']->declare_date : '';
        $date_to = (!empty($data['parliamentSession'])) ? $data['parliamentSession']->date_to : '';
        $current_date = date('Y-m-d');

        if ($current_date > $declare_date && $current_date < $date_to) {
            $data['current_parliament'] = 1;
        } else {
            $data['current_parliament'] = 0;
        }

        $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
        $where = '';

        if ($user_type !== 'speaker') {
            if ($user_type === 'mp') {
                /* if (!is_null($status_id)) {
                    $where = " where n.deleted_at IS NULL and n.status IN(" . $status_id . ") and (n.notice_from=" . authInfo()->id . " OR n.notice_to=" . authInfo()->id . ")";
                } else {
                    $where = " where n.deleted_at IS NULL and (n.notice_from=" . authInfo()->id . " OR n.notice_to=" . authInfo()->id . ")";
                } */
            } elseif ($user_type === 'staff') {
                if (!is_null($status_id)) {
                    $where = " where n.deleted_at IS NULL and n.status IN(" . $status_id . ") and r.department_id=" . authInfo()->department_id;
                } else {
                    $where = " where n.deleted_at IS NULL and (n.status between 1 and 4) and r.department_id=" . authInfo()->department_id;
                }
            } elseif ($user_type === 'ps') {
                $mp_data = DB::select("SELECT mp_user_id FROM mp_ps where ps_user_id=" . authInfo()->id);
                $mp_id = (!empty($mp_data)) ? $mp_data[0]->mp_user_id : 0;
                if (!is_null($status_id)) {
                    $where = " where n.deleted_at IS NULL and n.status IN(" . $status_id . ") and (n.notice_from=" . $mp_id . " OR n.notice_to=" . $mp_id . ")";
                } else {
                    $where = " where n.deleted_at IS NULL and (n.notice_from=" . $mp_id . " OR n.notice_to=" . $mp_id . ")";
                }
            }
        } else {
            if (!is_null($status_id)) {
                $where = " where n.deleted_at IS NULL and n.status IN(" . $status_id . ")";
            } else {
                $where = " where n.deleted_at IS NULL";
            }
        }

        // $where .= " order by n.id desc";

        $data['notices'] = DB::select($query . $where);

        /* 
            Department no
            111 = ICT
            222 = Notice
            333 = Deferral & Rights
            444 = Law 1
            555 = Law 2
            666 = Q & A
        */
        if ($department_id > 0 && $department_id == '111') {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.ict_department_index', $data);
        } else if ($department_id > 0 && $department_id == '222') {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice_department_index', $data);
        } else if ($department_id > 0 && $department_id == '333') {
            if ($status_id == 6) {
                $data['allRules'] = ParliamentRule::wherein('rule_number', [60, 62, 68, 71, 78, 82, 137, 147])->get();
            } else {
                $data['allRules'] = ParliamentRule::wherein('rule_number', [60, 62, 68, 71, 137, 147])->get();
            }

            $data['notice_status_id'] = 0;
            $data['notice_priority'] = 0;

            $data['topic_list'] = ($status_id == 1) ? 0 : 1;
            $data['parliament_session_list'] = ParliamentSession::orderBy('id', 'desc')->get();
            foreach ($data['parliament_session_list'] as $list) {
                $list->session_name = \Lang::get($list->session_no);
            }
            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.deferral_department_index', $data);
        } else if ($department_id > 0 && $department_id == '444') {

            $data['allRules'] = ParliamentRule::wherein('rule_number', [78, 82])->get();

            $data['notice_status_id'] = 0;
            $data['notice_priority'] = 0;

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.law1_department_index', $data);
        } else if ($department_id > 0 && $department_id == '555') {
            $data['notice_status_id'] = 0;
            $data['notice_priority'] = 0;

            $data['total_stage'] = DB::table('notice_stages')
                ->where('rule_number', 131)
                ->where('status', 1)
                ->distinct('stage')
                ->count('stage');

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }

            return view('backend.noticeManagement.notice.law2_index', $data);
        } else {
            if ($user_type === 'speaker') {
                $current_parliament_data = ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
                $data['current_parliament_session'] = (!empty($current_parliament_data)) ? $current_parliament_data->id : 0;
                $data['parliamentSession'] = ParliamentSession::orderBy('id', 'desc')->get();
                $data['start_date'] = (!empty($current_parliament_data)) ? $current_parliament_data->declare_date : '';
                $data['end_date'] = (!empty($current_parliament_data)) ? $current_parliament_data->date_to : '';

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }

                //for speech attachment
                /* $data['notices_with_speech'] = Notice::where('parliament_session_id',$data['current_parliament_session'])
                ->where('rule_number',78)
                ->where('status',6)
                ->get(); */

                return view('backend.noticeManagement.notice.speaker_index', $data);
            } else {

                if ($user_type === 'mp' || $user_type === 'ps') {
                    if (isApi()) {

                        $response['status'] = 'success';
                        $response['message'] = '';
                        $response['api_info']    = $data;
                        return response()->json($response);
                    }
                    return view('backend.noticeManagement.notice.index_mp', $data);
                } else {
                    if (isApi()) {

                        $response['status'] = 'success';
                        $response['message'] = '';
                        $response['api_info']    = $data;
                        return response()->json($response);
                    }
                    return view('backend.noticeManagement.notice.index', $data);
                }
            }
        }
    }

    public function notice_list(Request $request, $status_id = null)
    {
        $status_id = $request->status_id;
        $data['current_status_ids'] = (!is_null($status_id)) ? $status_id : 0;
        $data['allRules'] = ParliamentRule::orderBy('id', 'desc')->get();
        $user_type = authInfo()->usertype;
        $department_id = (authInfo()->department_id != '') ? Department::find(authInfo()->department_id)->department_no : 0;
        $data['user_type'] = $user_type;
        $data['parliamentSession'] = ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
        $declare_date = (!empty($data['parliamentSession'])) ? $data['parliamentSession']->declare_date : '';
        $date_to = (!empty($data['parliamentSession'])) ? $data['parliamentSession']->date_to : '';
        $current_date = date('Y-m-d');

        if ($current_date > $declare_date && $current_date < $date_to) {
            $data['current_parliament'] = 1;
        } else {
            $data['current_parliament'] = 0;
        }

        $query = "SELECT n.*, r.rule_number, r.name as rule_name, CONCAT(ufrom.name_bn,' (',c.bn_name,')') as from_user_name, CONCAT(uto.name_bn,' (',c.bn_name,')') as to_user_name, w.name_bn as wing_name, m.name_bn as ministry_name,  s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id left join ministry_wings w on w.id = n.to_wing_id left join ministries m on m.id = n.to_ministry_id";

        $where = '';

        if ($user_type !== 'speaker') {
            if ($user_type === 'mp') {
                if ($request->type === 'my_notices') {
                    if (!is_null($status_id)) {
                        $where = " where n.deleted_at IS NULL and n.status IN(" . $status_id . ") and n.notice_from=" . authInfo()->id;
                    } else {
                        $where = " where n.deleted_at IS NULL and n.notice_from=" . authInfo()->id;
                    }
                } else if ($request->type === 'received_notices') {
                    // conditions for receive notice(প্রাপ্ত নোটিশ) list will be here....
                    $where = " where n.id>0 and n.deleted_at IS NULL and parliament_session_id=" . $data['parliamentSession']->id . " and ("; //just for test
                    /* 
                        42(13),59(12) ... after approval from speaker
                        60(11) = no 
                        62(10) = no
                        68(9) = selected MPs page
                        71(8) = after approval from speaker
                        78(7) = Law 1 theke acceptable then it will be shown in received list
                        82(6) = Law 1 theke acceptable then it will be shown in received list
                        131(3): same condition as priority selection
                    */
                    $condition_for_42_59 = " (n.status=5 and n.rule_number IN(42,59)  and n.notice_to=" . authInfo()->id . " and n.discussed_date IS NULL) ";

                    $condition_for_68 = " (n.status=5 and n.rule_number=68 and FIND_IN_SET(" . authInfo()->id . ",n.mp_list)>0 and n.discussed_date IS NULL) ";

                    $condition_for_71 = " (n.status=5 and n.rule_number=71 and n.notice_to=" . authInfo()->id . " and n.discussed_date IS NULL) ";

                    $condition_for_78_82 = " (n.status=5 and n.rule_number IN(78,82) and n.notice_to=" . authInfo()->id . " and n.discussed_date IS NULL) ";

                    $condition_for_78_82_yesno = " (n.status=7 and n.rule_number IN(78.82) and n.notice_to=" . authInfo()->id . " and acceptance_duration>0) ";

                    $condition_for_131 = " (n.status=5 and n.rule_number=131 and n.notice_from=" . authInfo()->id . " and n.discussed_date IS NULL) ";

                    $where .= $condition_for_42_59 . " OR " . $condition_for_68 . " OR " . $condition_for_71 . " OR " . $condition_for_78_82 . " OR " . $condition_for_131 . " OR " . $condition_for_78_82_yesno . ")";

                    /* echo $query.$where;
                    die(); */
                }
            } elseif ($user_type === 'staff') {
                if (!is_null($status_id)) {
                    $status_condition = "";
                    if ((isset($request->rule_number)) && $request->rule_number > 0) {
                        if ($request->rule_number == 78 || $request->rule_number == 82) {
                            $status_condition = " and n.rule_number=" . $request->rule_number;
                        } /* else if ($request->rule_number == 11) {
                            $status_condition = " and n.rule_number IN(12,13)";
                            6 = 82, 7=78
                        } */ else {
                            $status_condition = " and n.rule_number=" . $request->rule_number . " and r.department_id=" . authInfo()->department_id;
                        }
                    } else {
                        if (isset($request->rule_number) && $request->rule_number == 0) {
                            if ($department_id == 333) {
                                $status_condition = " and n.rule_number IN(60,62,71,78,82,147)";
                            } else {
                                $status_condition = " and r.department_id=" . authInfo()->department_id;
                            }
                        }
                    }

                    if (isset($request->type) && $request->type === 'waiting_approval') {
                        if (isset($request->submission_date) && $request->submission_date != '') {
                            $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date='" . $request->submission_date . "' and n.yes_no_vote IS NULL " . $status_condition;
                        } else {
                            $where = " where n.deleted_at IS NULL and n.status=6 and n.yes_no_vote IS NULL and n.submission_date!='' " . $status_condition;
                        }
                    } else if (isset($request->type) && $request->type === 'waiting_submit') {
                        //$where = " where n.deleted_at IS NULL and n.status=6 and n.yes_no_vote IS NULL and n.submission_date IS NULL " . $status_condition;
                        $where = " where n.deleted_at IS NULL and n.status IN(1,6) and n.yes_no_vote IS NULL and n.submission_date IS NULL " . $status_condition;
                    } else if (isset($request->type) && $request->type === 'yes_no_tab') {
                        $where = " where n.deleted_at IS NULL and n.status=6 and n.yes_no_vote IS NOT NULL" . $status_condition;
                        if (isset($request->yes_no) && $request->yes_no != '') {
                            $where .= ' and n.yes_no_vote=' . $request->yes_no;
                        }
                    } else {
                        if (isset($request->rule_number) && ($request->rule_number == 0 || $request->rule_number == 2 || $request->rule_number == 78 || $request->rule_number == 82)) {
                            if ($department_id == 333) {
                                $rule_condition = ($request->rule_number > 0) ? " and n.status IN(" . $status_id . ")  and n.rule_number=" . $request->rule_number : " and n.status IN(" . $status_id . ") and n.rule_number IN(60,62,71,78,82,147)";
                            } else {
                                $rule_condition = ($request->rule_number > 0) ? " and n.status IN(" . $status_id . ")  and n.rule_number=" . $request->rule_number : " and n.status IN(" . $status_id . ")";
                            }
                            //$where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date IS NOT NULL " . $rule_condition;
                            $where = " where n.deleted_at IS NULL " . $rule_condition;
                        } else {
                            if (isset($request->rule_number)) {
                                $rule_condition = ($request->rule_number > 0) ? " and n.rule_number=" . $request->rule_number : "";
                            } else {
                                $rule_condition = " ";
                            }
                            $where = " where n.deleted_at IS NULL " . $rule_condition . " and n.status IN(" . $status_id . ") and r.department_id=" . authInfo()->department_id;
                        }
                    }
                } else {
                    $where = " where n.deleted_at IS NULL and (n.status between 1 and 4) and r.department_id=" . authInfo()->department_id;
                }
            } elseif ($user_type === 'ps') {
                $mp_data = DB::select("SELECT mp_user_id FROM mp_ps where ps_user_id=" . authInfo()->id);
                $mp_id = (!empty($mp_data)) ? $mp_data[0]->mp_user_id : 0;
                if (!is_null($status_id)) {
                    $where = " where n.deleted_at IS NULL and n.status IN(" . $status_id . ") and (n.notice_from=" . $mp_id . " OR n.notice_to=" . $mp_id . ")";
                } else {
                    $where = " where n.deleted_at IS NULL and (n.notice_from=" . $mp_id . " OR n.notice_to=" . $mp_id . ")";
                }
            }
        } else {
            if (!is_null($status_id)) {
                $where = " where n.deleted_at IS NULL and n.status IN(" . $status_id . ")";
            } else {
                $where = " where n.deleted_at IS NULL";
            }
        }

        if (isset($request->topic_id) && $request->topic_id > 0) {
            $where .= " and n.bill_topic = " . $request->topic_id;
        }
        if (isset($request->parliament_session_id)) {
            $where .= " and n.parliament_session_id = " . $request->parliament_session_id;
        }

        $where .= ' order by n.id desc';

        $notice_list = DB::select($query . $where);

        //if ($status_id == 1 || $status_id == 6) {
        if ($status_id > 0) {
            //check notices with (rule_number+role_id+stage)
            $my_roles = authInfo()->user_role->pluck('role_id');
            $stage_qurey = NoticeStage::whereIn('role_id', $my_roles)->get();

            $existing_consent_data = NoticeConsent::where('user_id', authInfo()->id)->get();

            //get list of stage_consent where notice_id in($notice_list ids) and 
            if (count($existing_consent_data) > 0) {
                //list next stage numbers with notice_ids found in existing record from stage_consent table
                $next_stage_numbers = [];
                $next_stages_consents = [];
                foreach ($existing_consent_data as $e) {
                    $next_stage_numbers[] = $e->stage_number + 1;
                }
                if (count($next_stage_numbers) > 0) {
                    $next_stages_consents = NoticeConsent::whereIn('notice_id', $existing_consent_data->pluck('notice_id'))
                        ->whereIn('stage_number', $next_stage_numbers) // current_stage+1
                        ->get();
                }
            }

            $data['notices'] = [];
            if (count($stage_qurey) > 0) {
                foreach ($notice_list as $n) {
                    //$n->next_stage_consent_value = 1;
                    if (count($existing_consent_data) > 0) {
                        foreach ($existing_consent_data as $ex) {
                            if ($ex->notice_id == $n->id) {
                                if (count($next_stages_consents) > 0) {
                                    foreach ($next_stages_consents as $nex) {
                                        if ($ex->notice_id == $nex->notice_id) {
                                            $n->next_stage_consent_value = $nex->user_consent;
                                        }
                                    }
                                }
                                $n->user_consent = $ex->user_consent;
                            }
                        }
                    }
                    foreach ($stage_qurey as $s) {
                        //if (($n->rule_number == $s->rule_number) && ($n->stage_number == $s->stage)) {
                        if (($n->rule_number == $s->rule_number)) {
                            if ($n->stage_number > $s->stage) {
                                $n->stage_finished = 1;
                            }
                            $data['notices'][] = $n;
                        }
                    }
                }
            }
        } else {
            $data['notices'] = $notice_list;
        }

        /* 
            Department no
            111 = ICT
            222 = Notice
            333 = Deferral & Rights
            444 = Law 1
            555 = Law 2
            666 = Q & A
        */

        if ($department_id > 0 && $department_id == '111') {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.ict_department_index', $data);
        } else if ($department_id > 0 && $department_id == '222') {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice_department_index', $data);
        } else if ($department_id > 0 && $department_id == '333') {
            /* 
                add conditions for Rule 68 that will link to public_discusstion table
                1. count total MP selected for any notice
                2. look for record from public_discussion with notice ids found in first step
                3. cross match if (total agree_condition = total mp_selected) for that notice
                4. just list down those Notices which hav been agreed upon from MP panel
            */
            if (isset($request->rule_number) && $request->rule_number == 68) {
                $final_notice_list = [];
                foreach ($data['notices'] as $n) {
                    $n->total_mp_selected = count(explode(',', $n->mp_list));
                    $notice_ids[] = $n->id;
                }

                $only_notice_ids = (!empty($notice_ids)) ? implode(',', $notice_ids) : '0';

                $discussion_agreement_notices = DB::select("SELECT notice_id, sum(agree_condition) as total_agree_disagree FROM public_discussion where notice_id IN(" . $only_notice_ids . ") group by notice_id");

                foreach ($data['notices'] as $n) {
                    foreach ($discussion_agreement_notices as $d) {
                        if ($n->id == $d->notice_id) {
                            if ($n->total_mp_selected == $d->total_agree_disagree) {
                                $final_notice_list[] = $n;
                            }
                        }
                    }
                }

                $data['notices'] = $final_notice_list;
            }

            $data['notice_status_id'] = 0;
            $data['notice_priority'] = 0;

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }

            // return view('backend.noticeManagement.notice.deferral_department_index', $data);
        } else if ($department_id > 0 && $department_id == '444') {
            $data['notice_status_id'] = 0;
            $data['notice_priority'] = 0;

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            // return view('backend.noticeManagement.notice.law1_department_index', $data);
        } else if ($department_id > 0 && $department_id == '555') {
            $data['notice_status_id'] = 0;
            $data['notice_priority'] = 0;

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            // return view('backend.noticeManagement.notice.law2_department_index', $data);
        } else {
            if ($user_type === 'speaker') {
                $current_parliament_data = ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
                $data['current_parliament_session'] = (!empty($current_parliament_data)) ? $current_parliament_data->id : 0;
                $data['parliamentSession'] = ParliamentSession::orderBy('id', 'desc')->get();
                $data['start_date'] = (!empty($current_parliament_data)) ? $current_parliament_data->declare_date : '';
                $data['end_date'] = (!empty($current_parliament_data)) ? $current_parliament_data->date_to : '';

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.speaker_index', $data);
            } else if ($user_type == 'mp') {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return  Datatables::of($data['notices'])
                    ->editColumn('rule_number', function ($row) {
                        return digitDateLang($row->rule_number);
                    })
                    ->editColumn('topic', function ($row) {
                        if ($row->rule_number == 78 || $row->rule_number == 82) {
                            $bill_topics = billTopicList($row->rule_number);
                            foreach ($bill_topics as $b) {
                                if ($row->bill_topic == $b['id']) {
                                    return $b['name'];
                                }
                            }
                        } else {
                            return $row->topic;
                        }
                    })
                    ->editColumn('to_user_name', function ($row) {
                        $to_whom = '';
                        if ($row->wing_name != '') {
                            $to_whom = $row->wing_name;
                        } else if ($row->ministry_name != '') {
                            $to_whom = $row->ministry_name;
                        } else {
                            $to_whom = ($row->notice_to != '' && $row->notice_to > 0) ? $row->to_user_name : '';
                        }
                        return $to_whom;
                    })
                    ->editColumn('date', function ($row) {
                        return ($row->submission_date != '') ? digitDateLang(nanoDateFormat($row->submission_date)) : digitDateLang(nanoDateFormat($row->created_at));
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->acceptance_tag != '') {
                            return ($row->acceptance_tag == 1) ? '<span class="badge status_span badge-info">' . \Lang::get('Acceptable') . '</span>' : '<span class="badge status_span badge-primary">' . \Lang::get('Acceptable with Correction') . '</span>';
                        } else {
                            return globalStatus('notice', $row->status);
                        }
                    })
                    ->addColumn('action', function ($row) use ($user_type, $request) {
                        $action_buttons = "";
                        if ($user_type == 'mp') {
                            if ($request->type === 'my_notices' && $row->notice_from == authInfo()->id) {
                                if ($row->status > 0) {
                                    $action_buttons = '<a class="btn btn-sm btn-success" href="' . route('admin.notice_management.notices.show', $row->id) . '"><i class="fa fa-eye"></i></a> ';
                                } else {
                                    $action_buttons = '<a class="btn btn-sm btn-success" href="' . route('admin.notice_management.notices.show', $row->id) . '"><i class="fa fa-eye"></i></a> <a class="btn btn-sm btn-info" href="' . route('admin.notice_management.notices.edit', $row->id) . '"> <i class="fa fa-edit"></i></a> <a class="btn btn-sm btn-danger destroy" data-route="' . route('admin.notice_management.notices.destroy', $row->id) . '"><i class="fa fa-trash"></i></a>';
                                }
                            } else if ($request->type === 'received_notices' && $row->notice_to == authInfo()->id && ($row->rule_number == 78 || $row->rule_number == 7)) {
                                if ($row->mp_acceptance != '') {
                                    $yes_class_toggle = ($row->mp_acceptance == 1) ? 'btn-success' : 'btn-secondary';
                                    $no_class_toggle = ($row->mp_acceptance == 0) ? 'btn-danger' : 'btn-secondary';

                                    $action_buttons = '<a class="btn btn-lg ' . $yes_class_toggle . '" id="speech_yes" onClick="confirm_acceptance(' . $row->id . ',1)"><i class="fa fa-check"> </i> ' . \Lang::get('Yes') . ' </a> <a class="btn btn-lg ' . $no_class_toggle . '" id="speech_no" onClick="confirm_acceptance(' . $row->id . ',0)"><i class="fa fa-times"> </i> ' . \Lang::get('No') . ' </a>';
                                } else {
                                    $action_buttons = '';
                                }
                            }
                        }
                        if ($user_type == 'staff' && $row->status > 0 && $row->status != 5) {
                            $action_buttons = "";
                            if ($row->rule_number == 78 || $row->rule_number == 82) {
                                //condition for 78/82 rules
                            } else {
                                $action_buttons = ' <a class="btn btn-sm btn-info" href="' . route('admin.notice_management.notices.edit', $row->id) . '"><i class="fa fa-edit"></i></a>';
                            }
                            //$action_buttons .= '<a class="btn btn-sm btn-info" href="#" onClick="edit_data(' . $row->id . ')"><i class="fa fa-edit"></i></a>';
                        }
                        return $action_buttons;
                    })
                    ->escapeColumns([]) // to render html
                    ->make(true);
            } else {
                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.index', $data);
            }
        }

        if ($user_type ==='staff') {
            $final_output = Datatables::of($data['notices']);
            $topic_and_user_column = Datatables::of($data['notices'])->editColumn('topic', function ($row) {
                if ($row->rule_number == 78 || $row->rule_number == 82) {
                    $bill_topics = billTopicList($row->rule_number);
                    foreach ($bill_topics as $b) {
                        if ($row->bill_topic == $b['id']) {
                            return $b['name'];
                        }
                    }
                } else {
                    return $row->topic;
                }
            })
                ->editColumn('to_user_name', function ($row) {
                    $to_whom = '';
                    if ($row->wing_name != '') {
                        $to_whom = $row->wing_name;
                    } else if ($row->ministry_name != '') {
                        $to_whom = $row->ministry_name;
                    } else {
                        $to_whom = ($row->notice_to != '' && $row->notice_to > 0) ? $row->to_user_name : '';
                    }
                    return $to_whom;
                });
            if ($department_id > 0 && $department_id == '333') {
                (object) array_merge((array)$final_output, (array)$topic_and_user_column);
            }
            //array_push($final_output,)    
            $common_columns =  Datatables::of($data['notices'])
                ->addColumn('checkButton', function ($row) use ($user_type) {
                    $check_button = '';
                    if ($user_type == 'staff') {
                        $check_button .= '<td><input style="width: 24px;" type="checkbox" data-id="' . $row->id . '" data-stage="' . $row->stage_number . '" class="form-control select_data"></td>';
                    }
                    return $check_button;
                })
                ->addIndexColumn()
                ->editColumn('rd_no', function ($row) {
                    return digitDateLang($row->rd_no);
                })
                ->editColumn('date', function ($row) {
                    return ($row->submission_date != '') ? digitDateLang(nanoDateFormat($row->submission_date)) : digitDateLang(nanoDateFormat($row->created_at));
                })
                ->addColumn('status', function ($row) {
                    if ($row->acceptance_tag != '') {
                        $return_tag = '';
                        $return_tag .= ($row->acceptance_tag == 1) ? '<span class="badge status_span badge-info">' . \Lang::get('Acceptable') . '</span>' : '<span class="badge status_span badge-primary">' . \Lang::get('Acceptable with Correction') . '</span>';
                        if (isset($row->user_consent) && $row->user_consent == 1) {
                            $return_tag .= ' <span class="btn btn-success disabled">' . Lang::get("Already Signed") . '</span>';
                            if (isset($row->next_stage_consent_value) && $row->next_stage_consent_value == 0) {
                                $return_tag .= ' <p><span class="btn btn-warning disabled">' . Lang::get("Returned") . '</span></p>';
                            }
                        } else if (isset($row->user_consent) && $row->user_consent == 0) {
                            $return_tag .= ' <span class="btn btn-danger disabled">' . Lang::get("Disagree") . '</span>';
                        }
                        return $return_tag;
                    } else {
                        if (isset($row->user_consent) && $row->user_consent == 1) {
                            $return_tag = '<span class="btn btn-success disabled">' . Lang::get("Already Signed") . '</span>';
                            if (isset($row->next_stage_consent_value) && $row->next_stage_consent_value == 0) {
                                $return_tag .= '<p><span class="btn btn-warning disabled">' . Lang::get("Returned") . '</span></p>';
                            }
                            return $return_tag;
                        } else if (isset($row->user_consent) && $row->user_consent == 0) {
                            return '<span class="btn btn-danger disabled">' . Lang::get("Disagree") . '</span>';
                        } else {
                            return globalStatus('notice', $row->status);
                        }
                    }
                })
                ->addColumn('action', function ($row) use ($user_type) {
                    //$action_buttons = (isset($row->stage_finished) && $row->stage_finished == 1) ? '' : ' <a class="btn btn-sm btn-success" href="' . route('admin.notice_management.notices.show', $row->id) . '"><i class="fa fa-eye"></i></a>';
                    $action_buttons = ' <a class="btn btn-sm btn-success" href="' . route('admin.notice_management.notices.show', $row->id) . '"><i class="fa fa-eye"></i></a>';

                    if ($user_type == 'mp' && $row->notice_from == authInfo()->id && $row->status == 0) {
                        $action_buttons .= ' <a class="btn btn-sm btn-info" href="' . route('admin.notice_management.notices.edit', $row->id) . '"> <i class="fa fa-edit"></i></a> <a class="btn btn-sm btn-danger destroy" data-route="' . route('admin.notice_management.notices.destroy', $row->id) . '"><i class="fa fa-trash"></i></a>';
                    }
                    if ($user_type == 'staff' && $row->status > 0 && $row->status != 5) {
                        $action_buttons .= ''; //' <a class="btn btn-sm btn-info" href="' . route('admin.notice_management.notices.edit', $row->id) . '"><i class="fa fa-edit"></i></a>';
                    }
                    return $action_buttons;
                })
                ->escapeColumns([]) // to render html
                ->make(true);

            $final_output = array_merge((array)$final_output, (array)$common_columns);
            return $final_output['original'];
        }
    }

    public function speaker_notice()
    {
        $data['allRules'] = ParliamentRule::orderBy('id', 'desc')->get();
        $current_parliament_data = ParliamentSession::where('status', 1)->first();
        $data['current_parliament_session'] = $current_parliament_data->id;
        $data['parliamentSession'] = ParliamentSession::orderBy('id', 'desc')->get();
        $data['start_date'] = $current_parliament_data->declare_date;
        $data['end_date'] = $current_parliament_data->date_to;


        if (isApi()) {

            $response['status'] = 'success';
            $response['message'] = '';
            $response['api_info']    = $data;
            return response()->json($response);
        }
        return view('backend.noticeManagement.notice.speaker_index', $data);
    }

    public function filtered_notice(Request $request)
    {
        $id = $request->id; //'1,2,3,4,5,6';

        $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, c.bn_name as voter_area, uto.name_bn as to_user_name,s.name_bn as status_name, p.session_no FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join constituencies c on c.id = ufrom.constituency_id left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join parliament_sessions p on p.id = n.parliament_session_id where n.deleted_at IS NULL and n.status IN(" . $id . ") and n.submission_date!=''";

        $query .= ($request->parliament_session_id > 0) ? ' and n.parliament_session_id=' . $request->parliament_session_id : '';


        if (isset($request->only_ammendment) && $request->only_ammendment == 0) {
            if (isset($request->yes_no) && $request->yes_no != '') {
                $query .= ($request->rule_number > 0) ? ' and n.rule_number=' . $request->rule_number . ' and n.yes_no_vote=' . $request->yes_no : ' and n.rule_number!=78';
            } else {
                $query .= ($request->rule_number > 0) ? ' and n.rule_number=' . $request->rule_number . ' and n.rule_number!=78' : ' and n.rule_number!=78';
            }
        } else {
            if (isset($request->yes_no) && $request->yes_no != '') {
                $query .= ($request->rule_number > 0) ? ' and n.rule_number=' . $request->rule_number . ' and n.yes_no_vote=' . $request->yes_no : ' and n.rule_number!=78';
            } else {
                $query .= ($request->rule_number > 0) ? ' and n.rule_number=' . $request->rule_number : '';
            }
        }

        if ($request->date_range != '') {
            $date_range = explode('-', $request->date_range);
            $start_date = Carbon::parse(str_replace('/', '-', $date_range[0]))->format('Y-m-d');
            $end_date = Carbon::parse(str_replace('/', '-', $date_range[1]))->format('Y-m-d');
            $query .= " and n.submission_date>='" . $start_date . "' and n.submission_date <='" . $end_date . "'";
        }
        if ($request->acceptance_duration != '' && $request->rule_number == 71) {
            $query .= " and n.acceptance_duration=" . $request->acceptance_duration;
        }

        $query .= ' order by n.submission_date desc';

        /* echo $query;
        die(); */
        $data = DB::select($query);

        if (!empty($data)) {
            $byGroup = $this->group_by("submission_date", json_decode(json_encode($data, true), true));
            $result = $byGroup;
            //echo 'data found';

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return  Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('details', function ($row) {
                    $final_data = '<table class="table table-striped">';
                    if ($row[0]['status'] == 6) {
                        $datewise_checkbox = '';
                        if ($row[0]['rule_number'] != 6 && $row[0]['rule_number'] != 78) {
                            $datewise_checkbox .= ' <input style="width: 24px; float: none; margin: 0 auto;" type="checkbox" class="form-control check_datewise_notice"  data-date="' . $row[0]['submission_date'] . '">';
                        }
                        $final_data .= '<tr><td style="vertical-align: middle; text-align:center;">' . digitDateLang(nanoDateFormat($row[0]['submission_date'])) . $datewise_checkbox . ' <br><a class="btn btn-sm btn-success approval_button d-none" onClick="giveMassApproval(5,' . $row[0]['rule_number'] . ')"> <i class="fa fa-check"> </i> ' . \Lang::get('Approved') . ' </a>&nbsp;<a class="btn btn-sm btn-danger approval_button d-none" onClick="giveMassApproval(2)"> <i class="fa fa-times"> </i> ' . \Lang::get('Rejected') . '</a></td><td><table class="table table-striped">';
                    } else if ($row[0]['status'] == 5) {
                        $datewise_checkbox = '';
                        $datewise_checkbox .= ' <input style="width: 24px; float: none; margin: 0 auto;" type="checkbox" class="form-control check_datewise_submitted_notice"  data-date="' . $row[0]['submission_date'] . '">';
                        $final_data .= '<tr><td style="vertical-align: middle; text-align:center;">' . digitDateLang(nanoDateFormat($row[0]['submission_date'])) . $datewise_checkbox . ' <br><a class="btn btn-sm btn-success discussed_button d-none" onClick="giveMassDiscussed(7,' . $row[0]['rule_number'] . ')"> <i class="fa fa-check"> </i> ' . \Lang::get('Discussed') . ' </a>&nbsp;<a class="btn btn-sm btn-danger discussed_button d-none" onClick="giveMassDiscussed(-1)"> <i class="fa fa-times"> </i> ' . \Lang::get('Closed') . '</a></td><td><table class="table table-striped">';
                    } else {
                        $final_data .= '<tr><td><table class="table table-striped">';
                    }

                    foreach ($row as $r) {
                        if ($r['rule_number'] == 78 || $r['rule_number'] == 82) {
                            //$details_button = '<a class="btn btn-sm btn-success" onClick="show_speech_settings(' . $r['id'] . ', '.$r['acceptance_duration'].')"> <i class="fa fa-eye"> ' . \Lang::get('Set Duration') . '</i></a> &nbsp;  <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';

                            if ($r['yes_no_vote'] != '') {
                                $details_button = ''; //'<a class="btn btn-sm btn-success" onClick="show_speech_settings(' . $r['id'] . ', ' . $r['acceptance_duration'] . ')"> <i class="fa fa-clock"> ' . \Lang::get('Set Duration') . '</i></a>';
                            } else {
                                if ($r['mp_acceptance'] == 1) {
                                    $yes_class_toggle = ($r['yes_no_vote'] == 1) ? 'btn-success' : 'btn-secondary';
                                    $no_class_toggle = ($r['yes_no_vote'] == 0) ? 'btn-danger' : 'btn-secondary';

                                    $details_button = '<a class="btn btn-sm btn-success" onClick="show_speech_settings(' . $r['id'] . ', ' . $r['acceptance_duration'] . ')"> <i class="fa fa-clock"> ' . \Lang::get('Set Duration') . '</i></a> &nbsp;  <a class="btn btn-lg ' . $yes_class_toggle . '" id="speech_yes" onClick="confirm_speech_duration(' . $r['id'] . ',1)"><i class="fa fa-check"> </i> ' . \Lang::get('Yes') . ' </a> <a class="btn btn-lg ' . $no_class_toggle . '" id="speech_no" onClick="confirm_speech_duration(' . $r['id'] . ',0)"><i class="fa fa-times"> </i> ' . \Lang::get('No') . ' </a>';
                                } else {
                                    $details_button = '<a class="btn btn-sm btn-success" onClick="show_speech_settings(' . $r['id'] . ', ' . $r['acceptance_duration'] . ')"> <i class="fa fa-clock"> ' . \Lang::get('Set Duration') . '</i></a>';
                                }
                            }

                            if ($r['acceptance_duration'] > 0) {
                                $speech_info = $r['acceptance_duration'] . ' mins ';
                                $yes_no_text = ($r['yes_no_vote'] == 0) ? \Lang::get('No') : \Lang::get('Yes');
                                $yes_no_text = '(' . $yes_no_text . ')';
                            } else {
                                $speech_info = '';
                                $yes_no_text = '';
                            }

                            $bill_topics = billTopicList();
                            foreach ($bill_topics as $b) {
                                if ($r['bill_topic'] == $b['id']) {
                                    $r['bill_topic'] =  $b['name'];
                                    break;
                                }
                            }

                            if ($r['status'] == 6) {
                                $checkbox_condition = '';
                                if ($r['rule_number'] != 78 && $r['rule_number'] != 82) {
                                    $checkbox_condition .= ' <input style="width: 24px;" type="checkbox" data-id="' . $r['id'] . '" class="form-control select_data item_date_' . $row[0]['submission_date'] . '" data-stage="' . $row[0]['stage_number'] . '">';
                                }
                                $final_data .= '<tr><td>' . $checkbox_condition . '</td><td>' . $r['from_user_name'] . ' ' . $speech_info . $yes_no_text . '</td><td>' . $r['voter_area'] . '</td><td class="comment_column">' . $r['bill_topic'] . '</td><td>' . $details_button . '</td></tr>';
                            } else {
                                $final_data .= '<tr><td>' . $r['from_user_name'] . ' ' . $speech_info . $yes_no_text . '</td><td>' . $r['voter_area'] . '</td><td class="comment_column">' . $r['bill_topic'] . '</td><td>' . $details_button . '</td></tr>';
                            }
                        } else {
                            $details_button = ($r['status'] !== 7 && $r['status'] !== -1) ? '<a class="btn btn-sm btn-success" onClick="view_data(' . $r['id'] . ')"> <i class="fa fa-eye"> ' . \Lang::get('Show') . '</i></a>' : '';

                            if ($r['status'] == 6) {
                                $final_data .= '<tr><td><input style="width: 24px;" type="checkbox" data-id="' . $r['id'] . '" class="form-control select_data item_date_' . $row[0]['submission_date'] . '" data-stage="' . $row[0]['stage_number'] . '" >' . '</td><td>' . $r['from_user_name'] . '</td><td>' . $r['voter_area'] . '</td><td class="comment_column">' . $r['topic'] . '</td><td>' . $details_button . '</td></tr>';
                            } else {
                                $checkbox_string = ($r['status'] !== 7 && $r['status'] !== -1) ? '<td><input style="width: 24px;" type="checkbox" data-id="' . $r['id'] . '" class="form-control select_discussed_data submitted_date_' . $row[0]['submission_date'] . '" >' . '</td>' : '';
                                $final_data .= '<tr>' . $checkbox_string . '<td>' . $r['from_user_name'] . '</td><td>' . $r['voter_area'] . '</td><td class="comment_column">' . $r['topic'] . '</td><td>' . $details_button . '</td></tr>';
                            }
                        }
                    }
                    $final_data .= '</table></td></tr></table>';
                    $final_data .= '</table>';
                    return $final_data;
                })

                ->escapeColumns([]) // to render html
                ->make(true);
        } else {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return  Datatables::of([])
                ->addIndexColumn()
                ->addColumn('details', function ($row) {
                })
                ->escapeColumns([])
                ->make(true);
        }
    }

    public function notice_data($type, $id)
    {
        $data['notices'] = Notice::where('id', $id)->first();
        $data['descriptions'] = json_decode($data['notices']['description']);
        $data['allProfileData'] = Profile::all();
        $user_type = authInfo()->usertype;
        $data['user_type'] = $user_type;
        $data['attachments'] = NoticeAttachment::where(array('attachment_type' => 1, 'notice_id' => $id))->get();
        $data['speech_attachments'] = NoticeAttachment::where(array('attachment_type' => 2, 'notice_id' => $id))->get();

        $data['rule_number'] = $data['notices']['rule_number'];
        if ($data['rule_number'] == 78) {

            // Parliamentary Bill
            $bill_id = (isset($data['descriptions']->bill_title)) ? $data['descriptions']->bill_title : 0;
            $data['bill'] = ParliamentBill::where('id', $bill_id)->first();

            // Standing Committeee
            $sCommittee_id = (isset($data['descriptions']->standing_committee)) ? $data['descriptions']->standing_committee : 0;
            $data['standingCommittee'] = StandingCommittee::where('id', $sCommittee_id)->first();

            // Proposed Assessment Committeee
            $profiles = Profile::orderBy('id', 'asc')->get();

            $mpName = "";
            $x = 1;
            $proposedCommittee = (isset($data['descriptions']->assessment_committee)) ? $data['descriptions']->assessment_committee : array('');
            foreach ($profiles as $profile) {
                if (in_array($profile->user_id, $proposedCommittee)) {
                    if (session()->get('language') == 'bn') {
                        $mpName .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                    } else {
                        $mpName .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                    }
                }
            }
            $data['proposedAssessmentCommittees'] = $mpName;

            // Assessment Committee
            $assessmentCommittees = AssessmentCommittee::orderBy('id', 'desc')->get();

            foreach ($assessmentCommittees as $committee) {
                $mpName = "";
                $x = 1;
                $committeeUserID = json_decode($committee->user_id);
                foreach ($profiles as $profile) {
                    if (in_array($profile->user_id, $committeeUserID)) {
                        if (session()->get('language') == 'bn') {
                            $mpName .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                        } else {
                            $mpName .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                        }
                    }
                }
                $committee->mp_name = $mpName;
            }
            $data['assessmentCommittees'] = $assessmentCommittees;

            // Add Name Assessment Committee
            $mpNameAdd = "";
            $x = 1;
            $nameAddOnCommittee = [(isset($data['descriptions']->assessment_committee_name_add)) ? (explode(",", $data['descriptions']->assessment_committee_name_add)) : array('')];
            foreach ($profiles as $profile) {
                if (in_array($profile->user_id, $nameAddOnCommittee[0])) {
                    if (session()->get('language') == 'bn') {
                        $mpNameAdd .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                    } else {
                        $mpNameAdd .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                    }
                }
            }
            $data['nameAddAssessmentCommittees'] = $mpNameAdd;

            // Cancel Name Assessment Committee
            $mpNameCancel = "";
            $x = 1;
            $nameCancelOnCommittee = [(isset($data['descriptions']->assessment_committee_name_cancel)) ? (explode(",", $data['descriptions']->assessment_committee_name_cancel)) : array('')];
            foreach ($profiles as $profile) {
                if (in_array($profile->user_id, $nameCancelOnCommittee[0])) {
                    if (session()->get('language') == 'bn') {
                        $mpNameCancel .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                    } else {
                        $mpNameCancel .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                    }
                }
            }
            $data['nameCancelAssessmentCommittees'] = $mpNameCancel;

            // Exchange Name Assessment Committee
            $mpNameExchangeFrom = "";
            $x = 1;
            $exchangeNameFromCommittee = [(isset($data['descriptions']->assessment_committee_existing_name_from)) ? (explode(",", $data['descriptions']->assessment_committee_existing_name_from)) : array('')];
            foreach ($profiles as $profile) {
                if (in_array($profile->user_id, $exchangeNameFromCommittee[0])) {
                    if (session()->get('language') == 'bn') {
                        $mpNameExchangeFrom .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                    } else {
                        $mpNameExchangeFrom .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                    }
                }
            }
            $mpNameExchangeTo = "";
            $y = 1;
            $exchangeNameToCommittee = [(isset($data['descriptions']->assessment_committee_existing_name_to)) ? (explode(",", $data['descriptions']->assessment_committee_existing_name_to)) : array('')];
            foreach ($profiles as $profile) {
                if (in_array($profile->user_id, $exchangeNameToCommittee[0])) {
                    if (session()->get('language') == 'bn') {
                        $mpNameExchangeTo .= '(' . __($y++) . ') ' . $profile->name_bn . '<br/>';
                    } else {
                        $mpNameExchangeTo .= '(' . __($y++) . ') ' . $profile->name_eng . '<br/>';
                    }
                }
            }
            $data['nameExchangeAssessmentCommitteeFrom'] = $mpNameExchangeFrom;
            $data['nameExchangeAssessmentCommitteeTo'] = $mpNameExchangeTo;
            // Notice 78 End
        }
        $data['status_list'] = \DB::select("select * from global_status where status_type='notice' and status_id>2 and status_id<6");

        if ($type == 'view') {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.partial.details_notice', $data);
        } else if ($type == 'edit') {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.partial.details_notice_edit', $data);
        } else {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }

            return response()->json($data);
        }
    }

    public function allNotices(Request $request)
    {
        if ($request->ajax()) {
            $status_id = $request->id;
            $data = DB::select("SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name,s.name_bn as status_name FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status where n.deleted_at IS NULL and n.status IN(" . $status_id . ")");

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }

            return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" onClick="view_data(' . $row->id . ')" class="btn btn-info btn-sm">' . \Lang::get('Show') . '</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if (isApi()) {

            $response['status'] = 'success';
            $response['message'] = '';
            $response['api_info']    = $data;
            return response()->json($response);
        } //
        return view('backend.noticeManagement.notice.notice_grid');
    }

    public function notice_priority()
    {
        /* 
            1. the notice should be in current parliament session
            2. status = 5
            3. notice_from = logged_in MP
        */
        $timestamp = time();
        if (date('D', $timestamp) === 'Wed') {
            // priority can be set only on wednesday..
            $data['notice_priority'] = 1;
        } else {
            // notify that priority can be set only on wednesday 
            //$data['notice_priority'] = 2;
            $data['notice_priority'] = 1;
        }
        //$data['allRules'] = ParliamentRule::orderBy('id', 'desc')->get();
        $user_type = authInfo()->usertype;
        $data['user_type'] = authInfo()->usertype;
        $department_id = (authInfo()->department_id != '') ? Department::find(authInfo()->department_id)->department_no : 0;
        if ($user_type === 'mp') {
            $data['notices'] = [];
            $current_parliament_session = ParliamentSession::where('status', 1)->first();

            $next_thursday = date('Y-m-d', strtotime('next thursday'));

            $check_lottery_record = Lottery::where('parliament_session_id', $current_parliament_session->id)
                ->where('discussion_date', $next_thursday)
                ->where('mp_id', authInfo()->id)->get();

            if (!empty($check_lottery_record[0])) {
                $data['notices'] = DB::select("SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name,s.name_bn as status_name FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status where n.deleted_at IS NULL and n.status=5 and n.status!=7 and n.rule_number=131 and parliament_session_id=" . $current_parliament_session->id . " and n.notice_from=" . authInfo()->id . " and n.discussed_date IS NULL order by n.priority desc");
            }

            $data['parliamentSession'] = $current_parliament_session;
            //$data['priority_done'] = Notice::where(array('status' => 5, 'notice_from' => authInfo()->id, 'parliament_session_id' => $current_parliament_session->id));

            /* $check_existing = Notice::where(array('status' => 5, 'notice_from' =>3, 'parliament_session_id' => $current_parliament_session->id))->whereNull('discussed_date')->where('priority','>',0)->get();

            echo '<pre>'.var_export($check_existing,true).'</pre>';
            die(); */

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }

            return view('backend.noticeManagement.notice.law2_department_index', $data);
        }
    }

    public function notify_ministry($type = null)
    {
        // if type==mp then the notices which were sent to my(loggedin mp) ministry will be displayed
        $user_type = authInfo()->usertype;
        $data['user_type'] = authInfo()->usertype;
        if ($user_type === 'staff') {
            $current_parliament_session =  ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
            $declare_date = (!empty($current_parliament_session)) ? $current_parliament_session->declare_date : '';
            $date_to = (!empty($current_parliament_session)) ? $current_parliament_session->date_to : '';
            $current_date = date('Y-m-d');

            if ($current_date > $declare_date && $current_date < $date_to) {
                $data['current_parliament'] = 1;
            } else {
                $data['current_parliament'] = 0;
            }

            $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
            $where = '';
            $where = " where n.deleted_at IS NULL and (n.status=5 and n.priority=1 and n.ministry_id=0) and r.department_id=" . authInfo()->department_id;

            $data['notices'] = DB::select($query . $where);

            $data['parliamentSession'] = $current_parliament_session;
        }
        if (!is_null($type) && $user_type === 'mp') {
            $current_parliament_session =  ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
            $declare_date = (!empty($current_parliament_session)) ? $current_parliament_session->declare_date : '';
            $date_to = (!empty($current_parliament_session)) ? $current_parliament_session->date_to : '';
            $current_date = date('Y-m-d');

            if ($current_date > $declare_date && $current_date < $date_to) {
                $data['current_parliament'] = 1;
            } else {
                $data['current_parliament'] = 0;
            }

            $cabinet_info = Cabinet::where("profile_id", authInfo()->id)->distinct()->pluck('ministry_id')->toArray();
            $ministry_ids = implode(',', $cabinet_info);
            if ($ministry_ids != '') {
                $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
                $where = '';
                //$where = " where n.deleted_at IS NULL and (n.status=5 and n.priority=1 and n.ministry_id=" . $profile_info->ministry_id . ")";
                $where = " where n.deleted_at IS NULL and (n.status=5 and n.priority=1 and n.ministry_id IN(" . $ministry_ids . "))";

                /* echo $query.$where;
                die(); */

                $data['notices'] = DB::select($query . $where);
            } else {
                $data['notices'] = [];
            }

            $data['parliamentSession'] = $current_parliament_session;
        }


        if (isApi()) {

            $response['status'] = 'success';
            $response['message'] = '';
            $response['api_info']    = $data;
            return response()->json($response);
        }
        return view('backend.noticeManagement.notice.index', $data);
    }

    public function recent_discussion($type = null)
    {
        // if type==mp then the notices which were sent to my(loggedin mp) ministry will be displayed
        $user_type = authInfo()->usertype;
        $data['user_type'] = authInfo()->usertype;
        if (!is_null($type) && $user_type === 'mp') {
            $current_parliament_session =  ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
            $declare_date = (!empty($current_parliament_session)) ? $current_parliament_session->declare_date : '';
            $date_to = (!empty($current_parliament_session)) ? $current_parliament_session->date_to : '';
            $current_date = date('Y-m-d');

            if ($current_date > $declare_date && $current_date < $date_to) {
                $data['current_parliament'] = 1;
            } else {
                $data['current_parliament'] = 0;
            }

            $public_data = DB::select("select * from public_discussion where mp_id=" . authInfo()->id);

            $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
            $where = '';
            $where = " where n.deleted_at IS NULL and find_in_set(" . authInfo()->id . ",mp_list)>0";

            $data['notices'] = DB::select($query . $where);

            if (count($data['notices']) > 0) {
                foreach ($data['notices'] as $n) {
                    if (count($public_data) > 0) {
                        foreach ($public_data as $d) {
                            if ($d->notice_id == $n->id) {
                                $n->mp_agree_condition = $d->agree_condition;
                            }
                        }
                    }
                }
            }

            $data['parliamentSession'] = $current_parliament_session;
        }

        $data['recent_discussion'] = 1;

        if (isApi()) {

            $response['status'] = 'success';
            $response['message'] = '';
            $response['api_info']    = $data;
            return response()->json($response);
        }
        return view('backend.noticeManagement.notice.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data['parliament_sessions'] = comboList('parliament_sessions');
        $data['bill_topics'] = billTopicList(82);
        $data['bill_topics_78'] = billTopicList(78);
        $data['committees'] = comboList('committee');
        $data['ministries'] = Ministry::all();

        $user = authInfo();

        if ($user->usertype == 'mp') {
            $whereMpUser = [
                'user_id' => $user->id,
            ];
        } elseif ($user->usertype == 'ps') {
            $whereMpUser = [
                'user_id' => $user['psMpInfo']['mp_user_id'],
            ];
        } else {
            $whereMpUser = '';
        }

        if ($whereMpUser) {
            $data['mpProfile'] = Profile::where($whereMpUser)->first();
        }

        $data['allProfileData'] =  DB::select("select p.*, c.bn_name as voter_area from profiles p left join constituencies c on c.id = p.constituency_id");
        //Profile::has('userInfo','constituency')->get(); // join with constinuency table
        $data['parliamentSession'] = ParliamentSession::where('status', 1)->first();

        $data['user'] = $user;

        $rule_number = $request->rule_number;
        $data['ruleData'] = ParliamentRule::where('rule_number', $rule_number)->first();

        $data['question_types'] =  ($rule_number == 42) ? comboList('question_types', 42) : comboList('question_types');

        if ($rule_number == 42) {
            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice42Rule.create', $data);
        } elseif ($rule_number == 59) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice59Rule.create', $data);
        } elseif ($rule_number == 60) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice60Rule.create', $data);
        } elseif ($rule_number == 62) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice62Rule.create', $data);
        } elseif ($rule_number == 68) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice68Rule.create', $data);
        } elseif ($rule_number == 71) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice71Rule.create', $data);
        } elseif ($rule_number == 78) {

            $data['bills'] = ParliamentBill::all();
            $data['standingCommittees'] = StandingCommittee::all();

            $assessmentCommittees = AssessmentCommittee::orderBy('id', 'desc')->get();
            $profiles = Profile::orderBy('id', 'desc')->get();

            foreach ($assessmentCommittees as $committee) {
                $mpName = "";
                $mpNameList = "";
                $mpNameWithoutCommittee = "";
                $x = 1;
                $committeeUserID = json_decode($committee->user_id);

                foreach ($profiles as $profile) {
                    if (in_array($profile->user_id, $committeeUserID)) {
                        if (session()->get('language') == 'bn') {
                            $mpName .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                            $mpNameList .= '<option value=' . $profile->user_id . '>' . $profile->name_bn . '</option>';
                        } else {
                            $mpName .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                            $mpNameList .= '<option value=' . $profile->user_id . '>' . $profile->name_eng . '</option>';
                        }
                    }
                    if (!in_array($profile->user_id, $committeeUserID)) {
                        if (session()->get('language') == 'bn') {
                            $mpNameWithoutCommittee .= '<option value=' . $profile->user_id . '>' . $profile->name_bn . '</option>';
                        } else {
                            $mpNameWithoutCommittee .= '<option value=' . $profile->user_id . '>' . $profile->name_eng . '</option>';
                        }
                    }
                }
                $committee->mp_name = $mpName;
                $committee->mp_name_list = $mpNameList;
                $committee->mp_name_without_committee = $mpNameWithoutCommittee;
            }
            $data['assessmentCommittees'] = $assessmentCommittees;


            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice78Rule.create', $data);
        } elseif ($rule_number == 82) {

            $data['bills'] = ParliamentBill::all();
            $data['subClauses'] = ParliamentBillSubClause::all();

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice82Rule.create', $data);
        } elseif ($rule_number == 131) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice131Rule.create', $data);
        } elseif ($rule_number == 164) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return view('backend.noticeManagement.notice.notice164Rule.create', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->date = (isset($request->date) && $request->date != '') ? date('Y-m-d', strtotime($request->date)) : null;
        // validation
        $rules = [
            'date' => 'sometimes|required',
            'notice_from' => 'required',
            'to_ministry_id' => 'sometimes|required',
            'to_wing_id' => 'sometimes|required',
            'topic' => 'sometimes|required',
            'bill_topic' => 'sometimes|required',
            'description.*' => 'required',
        ];
        $message = [
            'date.sometimes' => 'The date field is required.',
            'notice_from.required' => 'The Notice From field is required.',
            'to_ministry_id.sometimes' => 'The Ministry field is required.',
            'to_wing_id.sometimes' => 'The Ministry Wing field is required.',
            'topic.sometimes' => 'This field is required.',
            'bill_topic.sometimes' => 'This field is required.',
            'description.*.required' => 'This field is required.',
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $validator;
                return response()->json($response);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $notice = new Notice();

        $parliamentSession = ParliamentSession::where('status', 1)->first();
        $declare_date = $parliamentSession->declare_date;
        $date_to = $parliamentSession->date_to;
        $current_date = date('Y-m-d');

        $rule_number = $request->rule_number;

        // Database Insert
        $desc = $request->input('description');

        $description = json_encode($desc);
        $request['parliament_session_id'] = $parliamentSession->id;
        $request['is_verbal'] = $request->is_verbal ?? 0;

        try {
            if ($request->has('submit')) {
                if (authInfo()->usertype == 'mp') {
                    $request['status'] = 1;
                    $request['stage_number'] = 1;
                    if ($current_date > $declare_date && $current_date < $date_to) {
                        $countValue = $notice->where('status', '>', 0)->where('parliament_session_id', $parliamentSession->id)->count();
                        $request['rd_no'] = ($countValue + 1) ?? 0;
                    }
                } else {
                    $request['status'] = 0;
                    $request['stage_number'] = 0;
                }
            } elseif ($request->has('draft')) {
                $request['status'] = 0;
                $request['stage_number'] = 0;
            }

            if ($request->has('mp_list')) {
                $request['mp_list'] = implode(',', $request->input('mp_list'));
            }

            $request['date'] = $request->date;
            $request['description'] = $description;
            $request['to_ministry_id'] = (isset($request->to_ministry_id)) ? $request->to_ministry_id : 0;
            $request['to_wing_id'] = (isset($request->to_wing_id)) ? $request->to_wing_id : 0;

            $notice->fill($request->all());

            $todayDate = date('Y-m-d', strtotime(Carbon::today()));

            $created_at = "created_at";

            if ($rule_number == 42) {

                if ($request->date > $todayDate) {
                    $created_at = 'date';
                    $todayDate = $request['date'];
                } elseif ($request->date < $todayDate) {

                    if (isApi()) {
                        $response['status']    = 'error';
                        $response['message']    = 'Previous Date Not Permited.';
                        return response()->json($response);
                    }

                    return redirect()->route('admin.notice_management.notices.index')->with('error', 'Previous Date Not Permited.');
                }

                $today_notice = Notice::whereBetween($created_at, [$todayDate . " 00:00:00", $todayDate . " 13:59:59"])
                    ->where('notice_from', authInfo()->id)
                    ->where('rule_number', $rule_number)
                    ->where('deleted_at', null)
                    ->get();
                $non_star_question = Notice::whereBetween($created_at, [$todayDate . " 00:00:00", $todayDate . " 13:59:59"])
                    ->where('notice_from', authInfo()->id)
                    ->where('rule_number', $rule_number)
                    ->where('question_type', 0)
                    ->where('deleted_at', null)
                    ->get();
                $star_question = Notice::whereBetween($created_at, [$todayDate . " 00:00:00", $todayDate . " 23:59:59"])
                    ->whereBetween('date', [$todayDate . " 00:00:00", $todayDate . " 23:59:59"])
                    ->where('notice_from', authInfo()->id)
                    ->where('rule_number', $rule_number)
                    ->where('question_type', 1)
                    ->where('deleted_at', null)
                    ->get();
                $prime_minister_question = Notice::whereBetween($created_at, [$todayDate . " 00:00:00", $todayDate . " 23:59:59"])
                    ->where('notice_from', authInfo()->id)
                    ->where('rule_number', $rule_number)
                    ->where('deleted_at', null)
                    ->where('question_type', 2)
                    ->get();

                if ($request['question_type'] == 0 && count($non_star_question) < 3 && count($today_notice) < 10) {
                    $result = $notice->save();
                } elseif ($request['question_type'] == 1 && count($star_question) < 1 && count($today_notice) < 10) {
                    $result = $notice->save();
                } elseif ($request['question_type'] == 2 && count($prime_minister_question) < 1 && count($today_notice) < 10) {
                    $result = $notice->save();
                } else {
                    if (isApi()) {
                        $response['status']    = 'error';
                        $response['message']    = 'Already Submit This Notices';
                        return response()->json($response);
                    }
                    return redirect()->route('admin.notice_management.notices.index')->with('error', 'Already Submit This Notices');
                }
            } else {
                $result = $notice->save();
            }

            $notice_id = $notice->id;

            if ($request->hasfile('attachment')) {

                if ($files = $request->file('attachment')) {
                    foreach ($files as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'notice' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                        $folder = public_path('/backend/attachment/'); // Define folder path
                        $file->move($folder, $filename); // Upload image
                        $noticeAttachment = new NoticeAttachment();
                        $noticeAttachment->notice_id = $notice_id;
                        $noticeAttachment->attachment = $filename; // Set file path in database to filePath
                        $noticeAttachment->save();
                    }
                }
            }
            if ($result) {
                if (isApi()) {
                    $response['status'] = 'success';
                    $response['message'] = 'Data Saved successfully';

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return redirect()->route('admin.notice_management.notices.index')->with('success', 'Data Saved successfully');
            } else {
                if (isApi()) {
                    $response['status'] = 'error';
                    $response['message'] = 'Data does not save successfully';

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return redirect()->route('admin.notice_management.notices.create')->with('error', 'Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = 'Exception! Something went wrong please try again!';

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //$data['notices'] = DB::select("select n.*,m.name_bn as ministry_name, w.name_bn as wing_name from notices n left join ministries m on m.id = n.to_ministry_id left join ministry_wings w on n.to_wing_id = w.id where n.id=".$id); 
        $data['notices'] = Notice::where('notices.id', $id)
            ->leftJoin('ministries', 'notices.to_ministry_id', '=', 'ministries.id')
            ->leftJoin('ministry_wings', 'notices.to_wing_id', '=', 'ministry_wings.id')
            ->leftJoin('parliament_rules', 'notices.rule_number', '=', 'parliament_rules.rule_number')
            ->select('notices.*', 'ministries.name_bn as ministry_name', 'ministry_wings.name_bn as wing_name', 'parliament_rules.name as rule_name')
            ->first();


        if ($data['notices'] != null) {
            //count total stages of current rule_number(selected notice)
            $data['total_stage'] = DB::table('notice_stages')
                ->where('rule_number', $data['notices']->rule_number)
                ->where('status', 1)
                ->distinct('stage')
                ->count('stage');

            //$data['notice_consent_data'] = NoticeConsent::where('notice_id',$data['notices']->id)
            //->where('user_id',authInfo()->id)
            //->get();

            $data['notice_consent_data'] = NoticeConsent::where('notice_id', $data['notices']->id)
                ->leftJoin('users', 'users.id', '=', 'notice_consents.user_id')
                //->leftJoin('roles', 'roles.id', '=', DB::raw('(select role_id from notice_stages where rule_number=' . $data['notices']->rule_number . ' and stage=' . $data['notices']->stage_number . ')'))
                ->leftJoin('roles', 'roles.id', '=', DB::raw('(select role_id from notice_stages where rule_number=' . $data['notices']->rule_number . ' and stage=notice_consents.stage_number)'))
                ->select('notice_consents.*', 'users.name_bn as user_name', 'roles.name_bn as role_name')
                ->orderBy('notice_consents.stage_number')
                ->get();

            if (count($data['notice_consent_data']) > 0) {
                foreach ($data['notice_consent_data'] as $c) {
                    if ($c->user_id == authInfo()->id) {
                        $data['my_consent_data'] = $c;
                    }
                }
            }

            //dd($data['notice_consent_data']);
           /*  $my_roles = authInfo()->user_role->pluck('role_id');
            $stage_qurey = NoticeStage::whereIn('role_id', $my_roles)
                    ->where('rule_number', $data['notices']->rule_number)
                    ->where('stage', $data['notices']->stage_number)
                    ->get();
             */
            

            /* if ($data['notices']->status == 1) {
                $data['upper_step_approved'] = 0;
                $my_roles = authInfo()->user_role->pluck('role_id');
                
                $stage_qurey = NoticeStage::whereIn('role_id', $my_roles)
                    ->where('rule_number', $data['notices']->rule_number)
                    ->where('stage', $data['notices']->stage_number)
                    ->get();

                $next_stage_numbers = $data['notices']->stage_number; //$stage_qurey->pluck('stage');
                
                $next_stages_consent = NoticeConsent::where('notice_id', $data['notices']->id)
                ->where('stage_number', $next_stage_numbers) // current_stage+1
                ->first();
                    
                if ( count($stage_qurey) == 0) {                 
                    if (isApi()) {
                        $response['status']    = 'error';
                        $response['message']    = 'No Notice to view';
                        return response()->json($response);
                    }
                    return redirect()->back(); //route('admin.notice_management.notices.index')->with('error', 'No Notice to view');
                } 
            
            } */
            $data['descriptions'] = json_decode($data['notices']['description']);
            $data['allProfileData'] = Profile::all();
            $user_type = authInfo()->usertype;
            $data['user_type'] = $user_type;
            $data['attachments'] = NoticeAttachment::where('notice_id', $id)->get();
            $data['ministry_list'] = Ministry::where('status', 1)->get();
            $data['to_whom'] = '';
            if ($data['notices']->to_wing_id > 0) {
                $data['to_whom'] = $data['notices']->wing_name;
            } else if ($data['notices']->to_ministry_id > 0) {
                $data['to_whom'] = $data['notices']->ministry_name;
            } else {
                $data['to_whom'] = ($data['notices']->notice_to != '' && $data['notices']->notice_to > 0) ? $data['notices']->profileForNoticeTo->name_bn : '';
            }
            $rule_number = $data['notices']['rule_number'];

            /* if (authInfo()->usertype == 'staff') {
                $data['status_list'] = \DB::select("select * from global_status where status_type='notice' and status_id>2 and status_id<6");
            } */
            if (authInfo()->usertype == 'staff') {
                $data['status_list'] = \DB::select("select * from global_status where status_type='notice' and status_id IN(2,6)");
            }

            if ($rule_number == 42) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice42Rule.show', $data);
            } elseif ($rule_number == 59) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice59Rule.show', $data);
            } elseif ($rule_number == 60) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice60Rule.show', $data);
            } elseif ($rule_number == 62) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice62Rule.show', $data);
            } elseif ($rule_number == 68) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice68Rule.show', $data);
            } elseif ($rule_number == 71) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice71Rule.show', $data);
            } elseif ($rule_number == 78) {

                // Parliamentary Bill
                $bill_id = (isset($data['descriptions']->bill_title)) ? $data['descriptions']->bill_title : 0;
                $data['bill'] = ParliamentBill::where('id', $bill_id)->first();

                // Standing Committeee
                $sCommittee_id = (isset($data['descriptions']->standing_committee)) ? $data['descriptions']->standing_committee : 0;
                $data['standingCommittee'] = StandingCommittee::where('id', $sCommittee_id)->first();

                // Proposed Assessment Committeee
                $profiles = Profile::orderBy('id', 'asc')->get();

                $mpName = "";
                $x = 1;
                $proposedCommittee = (isset($data['descriptions']->assessment_committee)) ? $data['descriptions']->assessment_committee : array('');
                foreach ($profiles as $profile) {
                    if (in_array($profile->user_id, $proposedCommittee)) {
                        if (session()->get('language') == 'bn') {
                            $mpName .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                        } else {
                            $mpName .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                        }
                    }
                }
                $data['proposedAssessmentCommittees'] = $mpName;

                // Assessment Committee
                $assessmentCommittees = AssessmentCommittee::orderBy('id', 'desc')->get();

                foreach ($assessmentCommittees as $committee) {
                    $mpName = "";
                    $x = 1;
                    $committeeUserID = json_decode($committee->user_id);
                    foreach ($profiles as $profile) {
                        if (in_array($profile->user_id, $committeeUserID)) {
                            if (session()->get('language') == 'bn') {
                                $mpName .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                            } else {
                                $mpName .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                            }
                        }
                    }
                    $committee->mp_name = $mpName;
                }
                $data['assessmentCommittees'] = $assessmentCommittees;

                // Add Name Assessment Committee
                $mpNameAdd = "";
                $x = 1;
                $nameAddOnCommittee = [(isset($data['descriptions']->assessment_committee_name_add)) ? (explode(",", $data['descriptions']->assessment_committee_name_add)) : array('')];
                foreach ($profiles as $profile) {
                    if (in_array($profile->user_id, $nameAddOnCommittee[0])) {
                        if (session()->get('language') == 'bn') {
                            $mpNameAdd .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                        } else {
                            $mpNameAdd .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                        }
                    }
                }
                $data['nameAddAssessmentCommittees'] = $mpNameAdd;

                // Cancel Name Assessment Committee
                $mpNameCancel = "";
                $x = 1;
                $nameCancelOnCommittee = [(isset($data['descriptions']->assessment_committee_name_cancel)) ? (explode(",", $data['descriptions']->assessment_committee_name_cancel)) : array('')];
                foreach ($profiles as $profile) {
                    if (in_array($profile->user_id, $nameCancelOnCommittee[0])) {
                        if (session()->get('language') == 'bn') {
                            $mpNameCancel .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                        } else {
                            $mpNameCancel .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                        }
                    }
                }
                $data['nameCancelAssessmentCommittees'] = $mpNameCancel;

                // Exchange Name Assessment Committee
                $mpNameExchangeFrom = "";
                $x = 1;
                $exchangeNameFromCommittee = [(isset($data['descriptions']->assessment_committee_existing_name_from)) ? (explode(",", $data['descriptions']->assessment_committee_existing_name_from)) : array('')];
                foreach ($profiles as $profile) {
                    if (in_array($profile->user_id, $exchangeNameFromCommittee[0])) {
                        if (session()->get('language') == 'bn') {
                            $mpNameExchangeFrom .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                        } else {
                            $mpNameExchangeFrom .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                        }
                    }
                }
                $mpNameExchangeTo = "";
                $y = 1;
                $exchangeNameToCommittee = [(isset($data['descriptions']->assessment_committee_existing_name_to)) ? (explode(",", $data['descriptions']->assessment_committee_existing_name_to)) : array('')];
                foreach ($profiles as $profile) {
                    if (in_array($profile->user_id, $exchangeNameToCommittee[0])) {
                        if (session()->get('language') == 'bn') {
                            $mpNameExchangeTo .= '(' . __($y++) . ') ' . $profile->name_bn . '<br/>';
                        } else {
                            $mpNameExchangeTo .= '(' . __($y++) . ') ' . $profile->name_eng . '<br/>';
                        }
                    }
                }
                $data['nameExchangeAssessmentCommitteeFrom'] = $mpNameExchangeFrom;
                $data['nameExchangeAssessmentCommitteeTo'] = $mpNameExchangeTo;
                // Notice 78 End


                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice78Rule.show', $data);
            } elseif ($rule_number == 82) {

                // Parliamentary Bill
                $bill_id = (isset($data['descriptions']->bill_title)) ? $data['descriptions']->bill_title : 0;
                $data['bill'] = ParliamentBill::where('id', $bill_id)->first();


                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice82Rule.show', $data);
            } elseif ($rule_number == 131) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice131Rule.show', $data);
            } elseif ($rule_number == 164) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.show', $data);
                // return view('backend.noticeManagement.notice.notice164Rule.show', $data);
            }
        } else {
            if (isApi()) {
                $response['status']    = 'error';
                $response['message']    = 'No Notice to view';
                return response()->json($response);
            }
            return redirect()->route('admin.notice_management.notices.index')->with('error', 'No Notice to view');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['parliament_sessions'] = comboList('parliament_sessions');
        $data['bill_topics'] = billTopicList(82);
        $data['bill_topics_78'] = billTopicList(78);
        $data['committees'] = comboList('committee');
        $data['ministries'] = Ministry::all();

        //$data['editData'] = Notice::find($id);

        $data['editData'] = Notice::where('notices.id', $id)
            ->leftJoin('ministries', 'notices.to_ministry_id', '=', 'ministries.id')
            ->leftJoin('ministry_wings', 'notices.to_wing_id', '=', 'ministry_wings.id')
            ->leftJoin('parliament_rules', 'notices.rule_number', '=', 'parliament_rules.rule_number')
            ->select('notices.*', 'ministries.name_bn as ministry_name', 'ministry_wings.name_bn as wing_name', 'parliament_rules.name as rule_name')
            ->first();

        if (!empty($data['editData'])) {
            if ($data['editData']->notice_from != authInfo()->id || $data['editData']->status > 0) {

                if (isApi()) {
                    $response['status']    = 'error';
                    $response['message']    = 'not accesible';
                    return response()->json($response);
                }
                return 'not accesible';
            }

            $data['ministry_list'] = [];
            $data['wing_list'] = [];

            $ministry_ids = DB::select("SELECT GROUP_CONCAT(ministry_id) as ministry_list FROM circulars where date='" . $data['editData']->date . "'");
            if ($ministry_ids[0]->ministry_list != '') {
                $data['ministry_list'] = DB::select("select * from ministries where id IN(" . $ministry_ids[0]->ministry_list . ")");
            }

            $data['wing_list'] = MinistryWings::where('ministry_id', $data['editData']->to_ministry_id)->get();

            //$data['allProfileData'] = Profile::all();
            $data['allProfileData'] =  DB::select("select p.*, c.bn_name as voter_area from profiles p left join constituencies c on c.id = p.constituency_id");


            $data['descriptions'] = json_decode($data['editData']['description']);

            $data['attachments'] = NoticeAttachment::where(array('attachment_type' => 1, 'notice_id' => $id))->get();
            $data['speech_attachments'] = NoticeAttachment::where(array('attachment_type' => 2, 'notice_id' => $id))->get();

            $data['parliamentSession'] = ParliamentSession::where('status', 1)->first();

            $rule_number = $data['editData']['rule_number'];
            if (authInfo()->usertype == 'staff') {
                $data['status_list'] = \DB::select("select * from global_status where status_type='notice' and status_id IN(2,6)");
            }

            $data['question_types'] =  ($rule_number == 42) ? comboList('question_types', 42) : comboList('question_types');

            if ($rule_number == 42) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice42Rule.edit', $data);
            } elseif ($rule_number == 59) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice59Rule.edit', $data);
            } elseif ($rule_number == 60) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice60Rule.edit', $data);
            } elseif ($rule_number == 62) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice62Rule.edit', $data);
            } elseif ($rule_number == 68) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice68Rule.edit', $data);
            } elseif ($rule_number == 71) {


                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice71Rule.edit', $data);
            } elseif ($rule_number == 78) {

                $data['bills'] = ParliamentBill::all();
                $data['standingCommittees'] = StandingCommittee::all();

                $assessmentCommittees = AssessmentCommittee::orderBy('id', 'desc')->get();
                $profiles = Profile::orderBy('id', 'desc')->get();

                foreach ($assessmentCommittees as $committee) {
                    $mpName = "";
                    $mpNameList = "";
                    $mpNameWithoutCommittee = "";
                    $x = 1;
                    $committeeUserID = json_decode($committee->user_id);
                    foreach ($profiles as $profile) {
                        if (in_array($profile->user_id, $committeeUserID)) {
                            if (session()->get('language') == 'bn') {
                                $mpName .= '(' . __($x++) . ') ' . $profile->name_bn . '<br/>';
                                $mpNameList .= '<option value=' . $profile->user_id . '>' . $profile->name_bn . '</option>';
                            } else {
                                $mpName .= '(' . __($x++) . ') ' . $profile->name_eng . '<br/>';
                                $mpNameList .= '<option value=' . $profile->user_id . '>' . $profile->name_eng . '</option>';
                            }
                        }
                        if (!in_array($profile->user_id, $committeeUserID)) {
                            if (session()->get('language') == 'bn') {
                                $mpNameWithoutCommittee .= '<option value=' . $profile->user_id . '>' . $profile->name_bn . '</option>';
                            } else {
                                $mpNameWithoutCommittee .= '<option value=' . $profile->user_id . '>' . $profile->name_eng . '</option>';
                            }
                        }
                    }
                    $committee->mp_name = $mpName;
                    $committee->mp_name_list = $mpNameList;
                    $committee->mp_name_without_committee = $mpNameWithoutCommittee;
                }
                $data['assessmentCommittees'] = $assessmentCommittees;


                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice78Rule.edit', $data);
            } elseif ($rule_number == 82) {

                $data['bills'] = ParliamentBill::all();
                $parliament_bill_id = $data['descriptions']->bill_title;
                $data['clauses'] = ParliamentBillClause::where('parliament_bill_id', $parliament_bill_id)->get();
                $bill_clauses_id = $data['descriptions']->bill_clause;
                $data['subClauses'] = ParliamentBillSubClause::where('parliament_bill_id', $parliament_bill_id)->where('parliament_bill_clause_id', $bill_clauses_id)->get();

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice82Rule.edit', $data);
            } elseif ($rule_number == 131) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice131Rule.edit', $data);
            } elseif ($rule_number == 164) {

                if (isApi()) {

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $data;
                    return response()->json($response);
                }
                return view('backend.noticeManagement.notice.notice164Rule.edit', $data);
            }
        } else {
            if (isApi()) {
                $response['status']    = 'error';
                $response['message']    = 'no data found';
                return response()->json($response);
            }
            echo 'no data found';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->date = (isset($request->date) && $request->date != '') ? date('Y-m-d', strtotime($request->date)) : null;

        // validation
        $rules = [
            'date' => 'sometimes|required',
            'notice_from' => 'required',
            'to_ministry_id' => 'sometimes|required',
            'to_wing_id' => 'sometimes|required',
            'topic' => 'sometimes|required',
            'bill_topic' => 'sometimes|required',
            'description.*' => 'required',
        ];
        $message = [
            'date.sometimes' => 'The date field is required.',
            'notice_from.required' => 'The Notice From field is required.',
            'to_ministry_id.sometimes' => 'The Ministry field is required.',
            'to_wing_id.sometimes' => 'The Ministry Wing field is required.',
            'topic.sometimes' => 'This field is required.',
            'bill_topic.sometimes' => 'This field is required.',
            'description.*.required' => 'This field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);


        if ($validator->fails()) {
            if (isApi()) {
                return response()->json($validator->messages(), 200);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parliamentSession = ParliamentSession::where('status', 1)->first();

        $declare_date = $parliamentSession->declare_date;
        $date_to = $parliamentSession->date_to;
        $current_date = date('Y-m-d');


        /* echo '<pre>'.var_export($request,true).'</pre>';
        die(); */
        // Database Insert
        $desc = $request->input('description');

        $description = json_encode($desc);

        try {
            //dd($request->all());
            $request['date'] = $request->date;
            $request['to_ministry_id'] = (isset($request->to_ministry_id)) ? $request->to_ministry_id : 0;
            $request['to_wing_id'] = (isset($request->to_wing_id)) ? $request->to_wing_id : 0;
            $request['is_verbal'] = $request->is_verbal ?? 0;

            $notice = Notice::find($id);
            $request['description'] = $description;
            if ($request->has('mp_list')) {
                $request['mp_list'] = implode(',', $request->input('mp_list'));
            }
            if ($request->has('status_id') && $request->input('status_id') != '') {
                $request['status'] = $request->input('status_id');
                //$request['submission_date'] = date('Y-m-d');
                if ($request->has('comments') && $request->input('comments') != '') {
                    $request['comments'] = $request->input('comments');
                    $log_data['comments'] = $request->input('comments');
                }
                if ($request->has('acceptance_tag')) {
                    $request['acceptance_tag'] = $request->input('acceptance_tag');
                }
            } else if ($request->has('draft')) {
                $request['status'] = 0;
                $request['stage_number'] = 0;
            } else {
                $request['status'] = 1; // 1 = pending(already submitted by MP/PS)
                if (authInfo()->usertype == 'mp') {
                    $request['stage_number'] = 1;
                }
                if ($current_date > $declare_date && $current_date < $date_to) {
                    $countValue = $notice->where('status', '>', 0)->where('parliament_session_id', $parliamentSession->id)->count();
                    $request['rd_no'] = ($countValue + 1) ?? 0;
                }
            }

            //for log data entry
            $log_data = array(
                'notice_id' => $id,
                'previous_content' => json_encode($notice, true), //$notice->description,
                'current_content' => json_encode($request->all(), true), //$description,
                'previous_status' => $notice->status,
                'current_status' => $request['status'],
                'changed_by' => authInfo()->id,
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($request->has('comments') && $request->input('comments') != '') {
                $log_data['comments'] = $request->input('comments');
            }

            $notice->fill($request->all());

            if ($request->hasfile('attachment')) {

                // Delete Data to Notice Attachment Table
                $noticeAllAttachment = NoticeAttachment::where(array('attachment_type' => 1, 'notice_id' => $id))->get();
                foreach ($noticeAllAttachment as $attachmentFile) {
                    $folder = public_path('/backend/attachment/');
                    @unlink($folder . $attachmentFile->attachment);
                }
                NoticeAttachment::where(array('attachment_type' => 1, 'notice_id' => $id))->delete();

                if ($files = $request->file('attachment')) {
                    foreach ($files as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'notice' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                        $folder = public_path('/backend/attachment/'); // Define folder path
                        $file->move($folder, $filename); // Upload image

                        // Insert Data to Notice Attachment Table
                        $noticeAttachment = new NoticeAttachment();
                        $noticeAttachment->notice_id = $id;
                        $noticeAttachment->attachment = $filename; // Set file path in database to filePath
                        $noticeAttachment->save();
                    }
                }
            }

            if ($request->hasfile('speech_attachment')) {

                // Delete Data to Notice Attachment Table
                $speechAllAttachment = NoticeAttachment::where(array('attachment_type' => 2, 'notice_id' => $id))->get();
                foreach ($speechAllAttachment as $attachmentFile) {
                    $folder = public_path('/backend/attachment/');
                    @unlink($folder . $attachmentFile->attachment);
                }
                NoticeAttachment::where(array('attachment_type' => 2, 'notice_id' => $id))->delete();

                if ($files = $request->file('speech_attachment')) {
                    foreach ($files as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'notice' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                        $folder = public_path('/backend/attachment/'); // Define folder path
                        $file->move($folder, $filename); // Upload image

                        // Insert Data to Notice Attachment Table
                        $speechAllAttachment = new NoticeAttachment();
                        $speechAllAttachment->attachment_type = 2;
                        $speechAllAttachment->notice_id = $id;
                        $speechAllAttachment->attachment = $filename; // Set file path in database to filePath
                        $speechAllAttachment->save();
                    }
                }
            }

            $result = $notice->update();

            if ($result) {
                //insert into notice log table:
                DB::table('notice_log')->insert($log_data);
                //return redirect()->back()->with('success', 'Data update successfully');
                if (authInfo()->usertype == 'mp' || authInfo()->usertype == 'ps') {

                    if (isApi()) {
                        $response['status']    = 'success';
                        $response['message']    = 'Data update successfully';
                        return response()->json($response);
                    }
                    return redirect()->route('admin.notice_management.notices.index')->with('success', 'Data update successfully');
                } else if (authInfo()->usertype == 'staff') {
                }
                //return redirect()->route('admin.notice_management.notices.index')->with('success', 'Data update successfully');
            } else {
                //return redirect()->route('admin.notice_management.notices.index')->with('error', 'Data does not update successfully')->withInput();

                if (isApi()) {
                    $response['status']    = 'error';
                    $response['message']    = 'Data does not update successfully';
                    return response()->json($response);
                }
                return redirect()->back()->with('error', 'Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            if (isApi()) {
                $response['status']    = 'error';
                $response['message']    = 'Exception! Something went wrong please try again!';
                return response()->json($response);
            }
            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }

    public function notice_speech(Request $request, $id = null)
    {
        /* echo $request->notice_ids;
        die(); */
        $validator = Validator::make($request->all(), [
            'speech'  => 'required|mimes:doc,docx,pdf,txt|max:5048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if ($request->hasfile('speech')) {

            // Delete Data to Notice Attachment Table
            if (!is_null($id)) {
                $noticeSpeech = NoticeSpeech::where('id', $id)->get();
                foreach ($noticeSpeech as $attachmentFile) {
                    $folder = public_path('/backend/attachment/');
                    @unlink($folder . $attachmentFile->speech);
                }
                NoticeSpeech::where('id', $id)->delete();
            }

            //$existing_record = NoticeSpeech::where('notice_ids',$request->notice_ids)->get();
            $current_parliament_data = ParliamentSession::where('status', 1)->orderBy('id', 'desc')->first();
            $existing_record = Notice::where('parliament_session_id', $current_parliament_data->id)
                ->where('rule_number', 78)
                ->where('status', 6)
                ->get()->pluck('speech_id');

            if (!empty($existing_record)) {
                $file_to_delete = NoticeSpeech::where('id', $existing_record[0])->first();
                $folder = public_path('/backend/attachment/');
                @unlink($folder . $file_to_delete->speech);
                NoticeSpeech::where('id', $existing_record[0])->delete();
            }

            if ($files = $request->file('speech')) {
                //foreach ($files as $file) {
                $extension = $files->getClientOriginalExtension();
                $filename = 'notice' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                $folder = public_path('/backend/attachment/'); // Define folder path
                $files->move($folder, $filename); // Upload image
                // Insert Data to Notice Attachment Table
                $noticeSpeech = new NoticeSpeech();
                $noticeSpeech->speech = $filename; // Set file path in database to filePath
                $noticeSpeech->notice_ids = $request->notice_ids;
                $done = $noticeSpeech->save();
                if ($done) {
                    $request->notice_ids = explode(',', $request->notice_ids);
                    //update notice table with new speech_id
                    Notice::whereIn('id', $request->notice_ids)->update(array('speech_id' => $noticeSpeech->id));
                }
                // }

                if (isApi()) {
                    $response['status']    = 'success';
                    $response['message']    = '';

                    $response['status'] = 'success';
                    $response['message'] = '';
                    $response['api_info']    = $filename;
                    return response()->json($response);
                }
                return Response()->json([
                    "success" => true,
                    'file_name' => $filename
                ]);
            } else {
                if (isApi()) {
                    $response['status']    = 'error';
                    $response['message']    = '';
                    return response()->json($response);
                }
                return Response()->json([
                    "success" => false
                ]);
            }
        }
    }

    public function load_speech(Request $request)
    {
        $existing_record = Notice::where('parliament_session_id', $request->parliament_session_id)
            ->where('rule_number', 78)
            ->where('status', 6)
            ->get()->pluck('speech_id');

        if (!empty($existing_record)) {
            $fileData = NoticeSpeech::where('id', $existing_record[0])->first();

            if (isApi()) {

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $fileData;
                return response()->json($response);
            }
            // $folder = public_path('/backend/attachment/');
            return '<a href="' . asset('public/backend/attachment/' . $fileData->speech) . '" target="_blank">View Attachment</a>';
        } else {
            if (isApi()) {
                $response['status']    = 'error';
                $response['message']    = 'No Data Found';
                return response()->json($response);
            }
            return 'No Data Found';
        }
    }

    public function set_notice_data(Request $request)
    {
        /* 
            1. update all priority to 0 where(notice_from=current_mp, current_parliament_session)
            2. set pririty = 1 for the selected notice
            3. 
        */
        $current_parliament_session = ParliamentSession::where('status', 1)->first();
        $notice_from = authInfo()->id;
        $type = $request->type;

        if ($type == 'priority') {
            $id = $request->id;
            //MP can set priority once only.. now check if he/she has already set for the next thursday
            $check_existing = Notice::where(array('status' => 5, 'notice_from' => $notice_from, 'parliament_session_id' => $current_parliament_session->id))->whereNull('discussed_date')->where('priority', '>', 0)->get();

            if (empty($check_existing[0])) {
                $done = DB::table('notices')->where(array('id' => $id, 'status' => 5))->update(array('priority' => 1));
                if ($done) {
                    /* update lotteries table with notice_id
                        1. update where mp_id = loggedin_mp and discussion_date>today date
                        2. set notice_id = $id(comming from the ajax call)
                    */
                    $lottery_update = DB::table('lotteries')
                        ->where('mp_id', authInfo()->id)
                        ->where('discussion_date', '>', date('Y-m-d'))
                        ->update(array('notice_id' => $id));
                    if ($lottery_update) {
                        echo 1;
                    }
                } else {
                    echo 0;
                }
            } else {
                echo 2;
            }
            //$unset_all = DB::table('notices')->where(array('status' => 5, 'notice_from' => $notice_from, 'parliament_session_id' => $current_parliament_session->id))->whereNull('discussed_date')->update(array('priority' => 0));
        } else if ($type == 'status') {
            $status = 6; //(authInfo()->usertype == 'speaker')?5:6;
            $id = $request->id; //can be multiple by comma seperated values
            $done = DB::table('notices')->whereIn('id', $id)->update(array('status' => $status, 'submission_date' => date('Y-m-d')));
            if ($done) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'dept_status') {
            $status = $request->status;
            $id = $request->id;
            $comments = $request->comments;
            $done = DB::table('notices')->where('id', $id)->update(array('status' => $status, 'comments' => $comments, 'submission_date' => date('Y-m-d')));
            if ($done) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'notify_ministry') {
            $ministry_id = $request->ministry_id;
            $id = $request->id;
            $comments = $request->comments;
            $done = DB::table('notices')->where('id', $id)->update(array('ministry_id' => $ministry_id, 'comments' => $comments));
            if ($done) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'approval') {
            //only for speaker
            $acceptance_duration = (isset($request->acceptance_duration)) ? $request->acceptance_duration : 0;
            $status = $request->approval_status; // 2 = rejected, 5=approved
            $id = $request->id; //single array or array of IDS

            /* echo var_export($id,true);
            die(); */
            //$done = DB::table('notices')->where('id', $id)->update(array('status' => $status, 'acceptance_duration' => $acceptance_duration, 'approval_date' => date('Y-m-d')));
            $done = DB::table('notices')->whereIn('id', $id)->update(array('status' => $status, 'acceptance_duration' => $acceptance_duration, 'approval_date' => date('Y-m-d')));
            if ($done) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'yes_no') {
            $id = $request->id;
            $acceptance_duration = $request->acceptance_duration;
            $yes_no_vote = $request->yes_no_vote;
            if ($acceptance_duration > 0) {
                $done = DB::table('notices')->where('id', $id)->update(array('acceptance_duration' => $acceptance_duration));
            } else {
                $done = DB::table('notices')->where('id', $id)->update(array('yes_no_vote' => $yes_no_vote));
            }

            if ($done) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'mp_acceptance') {
            $id = $request->id;
            $mp_acceptance = $request->mp_acceptance;
            $done = DB::table('notices')->where('id', $id)->update(array('mp_acceptance' => $mp_acceptance));
            if ($done) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'recent_discussion') {
            $id = $request->id; //can be multiple by comma seperated values
            $agree_condition = $request->agree_condition;
            $mp_id = authInfo()->id;
            $existing_data = DB::table("public_discussion")->where(array('notice_id' => $id, 'mp_id' => $mp_id))->get();
            if (count($existing_data) > 0) {
                echo 2;
            } else {
                $done = DB::table('public_discussion')->insert(array('notice_id' => $id, 'mp_id' => $mp_id, 'agree_condition' => $agree_condition));
                if ($done) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        } else if ($type == 'discussed') {
            //speaker will make a notice "already discussed or closed(tamadi)"
            $status = $request->status;
            $id = $request->id; //single or comma seperated ids

            /* echo $status.PHP_EOL;
            echo var_export($id,true);
            die(); */

            if ($status == 7) {
                $done = DB::table('notices')->whereIn('id', $id)->update(array('status' => $status, 'discussed_date' => date('Y-m-d')));
            } else {
                $done = DB::table('notices')->whereIn('id', $id)->update(array('status' => $status));
            }

            if ($done) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'stage_consent') {
            //check the current stage with total stage of this notice
            //if this is the last stage... change the status to 6(go to speaker)
            //dd($request->all());
            $total_stages = $request->total_stage;
            $id = $request->id;
            $note = $request->stage_note;
            $user_consent = $request->user_consent;
            $stage_number = $request->stage_number;

            if ($stage_number == $total_stages) {
                $status = 6;
                $done = DB::table('notices')->where('id', $id)->update(array('status' => $status));
            } else if (isset($request->notice_status) && isset($request->acceptance_tag)) {
                $status = $request->notice_status;
                // we dont need to change the status except rejected ...  at this moment(12.06.2021)
                if ($status == 2) { //rejected from first layer
                    $done = DB::table('notices')->where('id', $id)->update(array('status' => $status, 'acceptance_tag' => $request->acceptance_tag));
                } else {
                    $done = DB::table('notices')->where('id', $id)->update(array('acceptance_tag' => $request->acceptance_tag));
                }
            }

            $existing_record = NoticeConsent::where('notice_id', $id)
                ->where('user_id', authInfo()->id)
                ->where('stage_number', $stage_number)
                ->get();
            if (!empty($existing_record)) {
                NoticeConsent::where('notice_id', $id)
                    ->where('user_id', authInfo()->id)
                    ->where('stage_number', $stage_number)->delete();
            }

            $done = NoticeConsent::UpdateOrCreate(
                array(
                    'notice_id' => $id,
                    'user_id' => authInfo()->id,
                    'stage_number' => $stage_number,
                    'note' => $note,
                    'user_consent' => $user_consent
                )
            );
            if ($done) {
                if ($user_consent == 1 && ($total_stages > $stage_number)) {
                    $stage_number = $stage_number + 1;
                    DB::table('notices')->where('id', $id)->update(array('stage_number' => $stage_number));
                }
                echo 1;
            } else {
                echo 0;
            }
        } else if ($type == 'mass_consent') {
            $total_stages = $request->total_stage;
            $id_stages = $request->id_stages;
            $id = $request->id; //comma seperated id string
            $note = $request->stage_note;
            $user_consent = $request->user_consent;

            //dd($request->all());
            // 1. look for notice consent with the given (user_id+notice_id+stage_number) and populate array with ids only
            //2. compare id_stages array with step 1 array with (notice_id and stage_number)
            // if match record, then delete them from notice_consent table
            //3. insert into notice_consent table with id_stages array record
            DB::beginTransaction();

            try {
                $existing_record = NoticeConsent::whereIn('notice_id', $id)
                    ->where('user_id', authInfo()->id)
                    ->get();
                if (count($existing_record) > 0) {
                    $deleted_array = array();
                    foreach ($id_stages as $s) {
                        foreach ($existing_record as $r) {
                            if ($r->notice_id == $s['id'] && $r->stage_number == $s['stage']) {
                                $deleted_array[] = $r->id;
                                //NoticeConsent::where('id', $r->id)->delete();
                            }
                        }
                    }
                    //dd($deleted_array);
                    //$ids = implode(',',$deleted_array);
                    // $del_done = NoticeConsent::destroy($deleted_array) ;
                    //NoticeConsent::whereIn('id', [5,6])->delete();
                    //DB::table('notice_consents')->whereIn('id',$deleted_array)->delete();
                    //echo $del_done;
                    //die();
                }

                $data = [];
                $updated_notice_ids = [];
                foreach ($id_stages as $s) {
                    $data[] = [
                        'notice_id' => $s['id'],
                        'user_id' => authInfo()->id,
                        'stage_number' => $s['stage'],
                        'note' => $note,
                        'user_consent' => $user_consent,
                        'created_by' => authInfo()->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    $updated_notice_ids[] = $s['id'];
                }

                $done = DB::table('notice_consents')->insert($data);

                if ($done) {
                    if ($user_consent == 1 && ($total_stages > $stage_number)) {
                        $stage_number = $stage_number + 1;
                        DB::table('notices')->whereIn('id', $updated_notice_ids)->update(array('stage_number' => $stage_number));
                    }
                    echo 1;
                } else {
                    echo 0;
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                echo 0;
            }
        }
    }

    public function make_lottery(Request $request)
    {
        $current_parliament_session = ParliamentSession::where('status', 1)->first();
        $start_date = $current_parliament_session->declare_date;
        $end_date = $current_parliament_session->date_to;

        $all_thursday = $this->getMyDayInRange('thursday', $start_date, $end_date);

        $first_day = $all_thursday[0];
        $last_day = $all_thursday[count($all_thursday) - 1];



        $existing_record = DB::select("select * from lotteries where discussion_date between '" . $first_day . "' and '" . $last_day . "'");

        if (empty($existing_record)) {
            //echo $first_day.'/'.$last_day;
            //if there is no record found in the lottery table
            $done = [];
            if (!empty($request->mp_ids)) {
                foreach ($request->mp_ids as $mp) {
                    $data = array(
                        'parliament_session_id' => $current_parliament_session->id,
                        'discussion_date' => $first_day,
                        'mp_id' => $mp,
                        'created_by' => authInfo()->id
                    );
                    $inserted = DB::table('lotteries')->insert($data);
                    if ($inserted) {
                        $done[] = 1;
                    }
                }
                if (!empty($done)) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        } else {
            echo 2; // Not allowed to run the  Lottery
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $notice = Notice::find($id);
            $notice->delete();
            // Delete Data to Notice Attachment Table
            $noticeAllAttachment = NoticeAttachment::where('notice_id', $id)->get();
            foreach ($noticeAllAttachment as $attachmentFile) {
                $folder = public_path('/backend/attachment/');
                @unlink($folder . $attachmentFile->attachment);
            }
            NoticeAttachment::where('notice_id', $id)->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }

    /**
     * Select All Notice by Discussed Date
     */
    public function discussedNotices(Request $request)
    {
        $discussed_date = date('Y-m-d', strtotime($request['previous_date']));
        $discussedNotices = Notice::where('discussed_date', $discussed_date)->where('rule_number', 42)->where('status', 7)->orderBy('rd_no')->get();
        if (count($discussedNotices) > 0) {
            foreach ($discussedNotices as $d) {
                $d->rd_no_custom = (session()->get('language') == 'bn') ? \Lang::get($d->rd_no) : $d->rd_no;
            }
        }
        return response()->json(array('data' => $discussedNotices));
    }

    public function ministryWingList(Request $request)
    {
        $type = $request->type;
        if ($type == 'ministry') {
            $circular_date = date('Y-m-d', strtotime($request->circular_date));

            $data['ministries'] = itemsDropdown('ministry', $circular_date);

            if (isApi()) {
                $response['status']    = 'success';
                $response['message']    = '';

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }

            return response()->json(array('data' => $data['ministries']));
        }
        if ($type == 'wing') {
            $ministry_id = $request->ministry_id;
            $data['wings'] = itemsDropdown('wing', '', $ministry_id);

            if (isApi()) {
                $response['status']    = 'success';
                $response['message']    = '';

                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $data;
                return response()->json($response);
            }
            return response()->json(array('data' => $data['wings']));
        }
    }

    private function getMyDayInRange($weekday, $dateFromString, $dateToString, $format = 'Y-m-d')
    {
        $dateFrom = new \DateTime($dateFromString);
        $dateTo = new \DateTime($dateToString);
        $dates = [];
        $today = date('Y-m-d');

        if ($dateFrom > $dateTo) {
            return $dates;
        }

        if (date('N', strtotime($weekday)) != $dateFrom->format('N')) {
            $dateFrom->modify("next $weekday");
        }

        while ($dateFrom <= $dateTo) {
            if ($dateFrom->format($format) > $today) {
                //show only thursday greater than today
                $dates[] = $dateFrom->format($format);
            }
            $dateFrom->modify('+1 week');
        }

        return $dates;
    }

    private function group_by($key, $data)
    {
        $result = array();

        foreach ($data as $val) {
            if (array_key_exists($key, $val)) {
                $result[$val[$key]][] = $val;
            } else {
                $result[""][] = $val;
            }
        }

        return $result;
    }

    /* PDF generator */
    public function create_pdf(Request $request, $department = null, $type = null)
    {
        /* 
        type = acceptable_notice | Lottery Winner | any kind of notice type
            for acceptable notice:
        */
        $template_name = 'notice_list';
        $pdf_file_name = 'Test_File_name';
        if ($department == 'law2') {
            if ($type === 'acceptable_notice') {
                $pdf_file_name = \Lang::get('Acceptable List');
                $data['message'] = "hello.... I am Mr. Nothing";
                $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
                $where = '';

                if (isset($request->submission_date) && $request->submission_date != '') {
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date='" . $request->submission_date . "' and r.department_id=" . authInfo()->department_id;
                } else {
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date!='' and r.department_id=" . authInfo()->department_id;
                }

                $data['notice_head'] = '<div class="notice_head_title">বাংলাদেশ জাতীয় সংসদ সচিবালয় 
                <br>
                লেজিসলেটিভ সাপোর্ট উইং
                <br>
                আইন শাখা-২
                </div>
                <div class="notice_header_content">একাদশ জাতীয় সংসদের ষষ্ঠ(২০২০ খ্রিষ্টাব্দের ১ম) অধিবেশন উপলক্ষে বেসরকারী সদস্যবৃন্দের নিকট হতে প্রাপ্ত ও <u>মাননীয় স্পীকার কতৃক ব্যালটের জন্য গ্রহনযোগ্য সিদ্বান্ত প্রস্তাবের তালিকা(১৩১ বিধি)</u></div>

                <div class="notice_header_content">মাননীয় সংসদ-সদস্যবৃন্দের নিম্নবর্ণিত সিদ্বান্ত-প্রস্তাবগুলো তালিকায় অন্তর্ভুক্তির জন্য মাননীয় স্পীকার কতৃক গ্রহনযোগ্য হয়েছে। প্রতি বেসরকারী সদস্যদের কার্যদিবসে সংসদে আলোচনার নিমিত্ত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সদস্যবৃন্দকে নিজ নিজ সিদ্বান্ত প্রস্তাবের একটি মাত্র সংখ্যার পার্শ্বে স্বাক্ষরের মাধ্যমে প্রাধাণ্য নির্নয়ের জন্য অনুরোধ করা হলো। তালিকায় বর্ণিত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সংসদ সদস্যবৃন্দের মধ্য হতে ব্যালটের মাধ্যমে ০৫ জন মাননীয় সদস্যের নাম ও তাদের প্রাধান্নপ্রাপ্ত সিদ্বান্ত-প্রস্তাব চুড়ান্তভাবে নির্বাচন করা হবে।  </div>';

                $data['notice_list'] = DB::select($query . $where);
            }
        } else if ($department == 'dr') {
            if ($type === 'acceptable_notice') {

                $ruleName = (isset($request->rule_name)) ? $request->rule_name : ' ';

                $pdf_file_name = \Lang::get('Acceptable List');
                $data['message'] = "hello.... I am Mr. Nothing";
                $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
                $where = '';

                if (isset($request->submission_date) && $request->submission_date != '') {
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date='" . $request->submission_date . "' and r.department_id=" . authInfo()->department_id;
                } else {
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date!='' and r.department_id=" . authInfo()->department_id;
                }

                if (isset($request->rule_number) && $request->rule_number > 0) {
                    $where .= ' and n.rule_number=' . $request->rule_number;
                }

                $data['notice_head'] = '<div class="notice_head_title">বাংলাদেশ জাতীয় সংসদ সচিবালয় 
                <br>
                লেজিসলেটিভ সাপোর্ট উইং
                <br>
                মুলতবি শাখা
                </div>
                <div class="notice_header_content">একাদশ জাতীয় সংসদের ষষ্ঠ(২০২০ খ্রিষ্টাব্দের ১ম) অধিবেশন উপলক্ষে বেসরকারী সদস্যবৃন্দের নিকট হতে প্রাপ্ত ও <u>মাননীয় স্পীকার কতৃক ব্যালটের জন্য গ্রহনযোগ্য সিদ্বান্ত প্রস্তাবের তালিকা(' . $ruleName . ' বিধি)</u></div>

                <div class="notice_header_content">মাননীয় সংসদ-সদস্যবৃন্দের নিম্নবর্ণিত সিদ্বান্ত-প্রস্তাবগুলো তালিকায় অন্তর্ভুক্তির জন্য মাননীয় স্পীকার কতৃক গ্রহনযোগ্য হয়েছে। প্রতি বেসরকারী সদস্যদের কার্যদিবসে সংসদে আলোচনার নিমিত্ত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সদস্যবৃন্দকে নিজ নিজ সিদ্বান্ত প্রস্তাবের একটি মাত্র সংখ্যার পার্শ্বে স্বাক্ষরের মাধ্যমে প্রাধাণ্য নির্নয়ের জন্য অনুরোধ করা হলো। তালিকায় বর্ণিত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সংসদ সদস্যবৃন্দের মধ্য হতে ব্যালটের মাধ্যমে ০৫ জন মাননীয় সদস্যের নাম ও তাদের প্রাধান্নপ্রাপ্ত সিদ্বান্ত-প্রস্তাব চুড়ান্তভাবে নির্বাচন করা হবে।  </div>';

                $data['notice_list'] = DB::select($query . $where);
            } else if ($type === 'bill_amendment') {
                $pdf_file_name = \Lang::get('Bill Amendment List');
                $data['message'] = "hello.... I am Mr. Nothing";
                $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
                $where = '';

                if (isset($request->submission_date) && $request->submission_date != '') {
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date='" . $request->submission_date . "' and r.department_id=" . authInfo()->department_id;
                } else {
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date!='' and r.department_id=" . authInfo()->department_id;
                }

                $data['notice_head'] = '<div class="notice_head_title">বাংলাদেশ জাতীয় সংসদ সচিবালয় 
                <br>
                লেজিসলেটিভ সাপোর্ট উইং
                <br>
                মুলতবি শাখা
                </div>
                <div class="notice_header_content">একাদশ জাতীয় সংসদের ষষ্ঠ(২০২০ খ্রিষ্টাব্দের ১ম) অধিবেশন উপলক্ষে বেসরকারী সদস্যবৃন্দের নিকট হতে প্রাপ্ত ও <u>মাননীয় স্পীকার কতৃক ব্যালটের জন্য গ্রহনযোগ্য সিদ্বান্ত প্রস্তাবের তালিকা(৭১ বিধি)</u></div>

                <div class="notice_header_content">মাননীয় সংসদ-সদস্যবৃন্দের নিম্নবর্ণিত সিদ্বান্ত-প্রস্তাবগুলো তালিকায় অন্তর্ভুক্তির জন্য মাননীয় স্পীকার কতৃক গ্রহনযোগ্য হয়েছে। প্রতি বেসরকারী সদস্যদের কার্যদিবসে সংসদে আলোচনার নিমিত্ত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সদস্যবৃন্দকে নিজ নিজ সিদ্বান্ত প্রস্তাবের একটি মাত্র সংখ্যার পার্শ্বে স্বাক্ষরের মাধ্যমে প্রাধাণ্য নির্নয়ের জন্য অনুরোধ করা হলো। তালিকায় বর্ণিত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সংসদ সদস্যবৃন্দের মধ্য হতে ব্যালটের মাধ্যমে ০৫ জন মাননীয় সদস্যের নাম ও তাদের প্রাধান্নপ্রাপ্ত সিদ্বান্ত-প্রস্তাব চুড়ান্তভাবে নির্বাচন করা হবে।  </div>';

                $data['notice_list'] = DB::select($query . $where);
            } else if ($type === 'yes_no_list') {
                $pdf_file_name = \Lang::get('YES NO VOTE List');
                $data['message'] = "hello.... I am Mr. Nothing";
                $query = "SELECT n.*, r.rule_number, r.name as rule_name, ufrom.name_bn as from_user_name, uto.name_bn as to_user_name, s.name_bn as status_name, c.bn_name as voter_area FROM notices n left join parliament_rules r on r.rule_number=n.rule_number left join profiles ufrom on ufrom.user_id = n.notice_from left join profiles uto on uto.user_id = n.notice_to left join global_status s on s.status_id = n.status left join constituencies c on c.id = ufrom.constituency_id";
                $where = '';

                $status_condition = "";


                if (isset($request->submission_date) && $request->submission_date != '') {
                    if (isset($request->yes_no) && $request->yes_no != '') {
                        $status_condition .= ' and n.yes_no_vote=' . $request->yes_no;
                    } else {
                        $status_condition .= ' and n.yes_no_vote IS NOT NULL';
                    }
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date='" . $request->submission_date . "' " . $status_condition;
                } else {
                    if (isset($request->yes_no) && $request->yes_no != '') {
                        $status_condition .= ' and n.yes_no_vote=' . $request->yes_no;
                    } else {
                        $status_condition .= ' and n.yes_no_vote IS NOT NULL';
                    }
                    $where = " where n.deleted_at IS NULL and n.status=6 and n.submission_date!='' " . $status_condition;
                }

                $data['notice_head'] = '<div class="notice_head_title">বাংলাদেশ জাতীয় সংসদ সচিবালয় 
                <br>
                YES NO SUPPORT WING
                <br>
                মুলতবি শাখা
                </div>
                <div class="notice_header_content">একাদশ জাতীয় সংসদের ষষ্ঠ(২০২০ খ্রিষ্টাব্দের ১ম) অধিবেশন উপলক্ষে বেসরকারী সদস্যবৃন্দের নিকট হতে প্রাপ্ত ও <u>মাননীয় স্পীকার কতৃক ব্যালটের জন্য গ্রহনযোগ্য সিদ্বান্ত প্রস্তাবের তালিকা(৭১ বিধি)</u></div>

                <div class="notice_header_content">মাননীয় সংসদ-সদস্যবৃন্দের নিম্নবর্ণিত সিদ্বান্ত-প্রস্তাবগুলো তালিকায় অন্তর্ভুক্তির জন্য মাননীয় স্পীকার কতৃক গ্রহনযোগ্য হয়েছে। প্রতি বেসরকারী সদস্যদের কার্যদিবসে সংসদে আলোচনার নিমিত্ত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সদস্যবৃন্দকে নিজ নিজ সিদ্বান্ত প্রস্তাবের একটি মাত্র সংখ্যার পার্শ্বে স্বাক্ষরের মাধ্যমে প্রাধাণ্য নির্নয়ের জন্য অনুরোধ করা হলো। তালিকায় বর্ণিত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সংসদ সদস্যবৃন্দের মধ্য হতে ব্যালটের মাধ্যমে ০৫ জন মাননীয় সদস্যের নাম ও তাদের প্রাধান্নপ্রাপ্ত সিদ্বান্ত-প্রস্তাব চুড়ান্তভাবে নির্বাচন করা হবে।  </div>';

                $data['notice_list'] = DB::select($query . $where);

                if (!empty($data['notice_list'])) {
                    foreach ($data['notice_list'] as $n) {
                        if ($n->rule_number == 78 || $n->rule_number == 82) {
                            $bill_topics = billTopicList($n->rule_number);
                            foreach ($bill_topics as $b) {
                                if ($n->bill_topic == $b['id']) {
                                    $n->topic = $b['name'];
                                }
                            }
                        }
                    }
                }
            } else if ($type === 'topicwise') {
                $data['summary_view'] = 1;
                //summary report according to the Topic
                $mp_lists = \DB::select("select GROUP_CONCAT(notice_from) as mp_ids from notices where deleted_at IS NULL and status=6 and submission_date!='' and (rule_number==78 || rule_number==82) ");

                if (!empty($mp_lists)) {
                    $data['summary_list'] = \DB::select("select n.bill_topic, n.rule_number, GROUP_CONCAT(id) as notice_ids, (select GROUP_CONCAT(name_bn) from profiles where user_id IN(" . $mp_lists[0]->mp_ids . ")) as mp_names, GROUP_CONCAT(notice_from)as mp_list, count(id) as total_notice from notices n where n.deleted_at IS NULL and n.status=6 and n.submission_date!='' and n.bill_topic IS NOT NULL group by n.bill_topic");
                }

                /* echo $mp_lists[0]->mp_ids;
                die(); */

                if (!empty($data['summary_list'])) {
                    foreach ($data['summary_list'] as $n) {
                        if ($n->rule_number == 78 || $n->rule_number == 82) {
                            $bill_topics = billTopicList($n->rule_number);
                            foreach ($bill_topics as $b) {
                                if ($n->bill_topic == $b['id']) {
                                    $n->topic = $b['name'];
                                }
                            }
                        }
                    }
                }

                $pdf_file_name = \Lang::get('Topicwise Report');

                $data['notice_head'] = '<div class="notice_head_title">বাংলাদেশ জাতীয় সংসদ সচিবালয় 
                <br>
                ' . \Lang::get('Topicwise Report') . ': ' . $request->topic_id . '
                <br>
                মুলতবি শাখা
                </div>
                <div class="notice_header_content">একাদশ জাতীয় সংসদের ষষ্ঠ(২০২০ খ্রিষ্টাব্দের ১ম) অধিবেশন উপলক্ষে বেসরকারী সদস্যবৃন্দের নিকট হতে প্রাপ্ত ও <u>মাননীয় স্পীকার কতৃক ব্যালটের জন্য গ্রহনযোগ্য সিদ্বান্ত প্রস্তাবের তালিকা(৭১ বিধি)</u></div>

                <div class="notice_header_content">মাননীয় সংসদ-সদস্যবৃন্দের নিম্নবর্ণিত সিদ্বান্ত-প্রস্তাবগুলো তালিকায় অন্তর্ভুক্তির জন্য মাননীয় স্পীকার কতৃক গ্রহনযোগ্য হয়েছে। প্রতি বেসরকারী সদস্যদের কার্যদিবসে সংসদে আলোচনার নিমিত্ত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সদস্যবৃন্দকে নিজ নিজ সিদ্বান্ত প্রস্তাবের একটি মাত্র সংখ্যার পার্শ্বে স্বাক্ষরের মাধ্যমে প্রাধাণ্য নির্নয়ের জন্য অনুরোধ করা হলো। তালিকায় বর্ণিত সিদ্বান্ত প্রস্তাবের নোটিশ প্রদানকারী মাননীয় সংসদ সদস্যবৃন্দের মধ্য হতে ব্যালটের মাধ্যমে ০৫ জন মাননীয় সদস্যের নাম ও তাদের প্রাধান্নপ্রাপ্ত সিদ্বান্ত-প্রস্তাব চুড়ান্তভাবে নির্বাচন করা হবে।  </div>';

                //$data['notice_list'] = DB::select($query . $where);
            }
        }


        $pdf = PDF::loadView('backend.pdf.' . $template_name, $data);
        //$pdf->render();
        //return response()->download($pdf_file_name . '.pdf');
        return $pdf->stream($pdf_file_name . '.pdf');
    }

    public function getNoticeListFromMpPortal(Request $request)
    {
        if ($request->token == 'EmBxttK6cb2wnRd6tSojz9O5jhjkyuisRdyPnkkDjkkjgfgfEKb53zaA6OWEHPd2Zjl') {

            $where = [];
            if ($request->parliament_session_id) {
                $where[] = ['parliament_session_id', '=', $request->parliament_session_id];
            }
            if ($request->date) {
                $where[] = ['date', '=', date('Y-m-d', strtotime($request->date))];
            }
            if ($request->question_type) {
                $where[] = ['question_type', '=', $request->question_type];
            }
            if ($request->rule_number) {
                $where[] = ['rule_number', '=', $request->rule_number];
            }
            if ($request->notice_from) {
                $where[] = ['notice_from', '=', $request->notice_from];
            }

            $notice_list = Notice::where($where)->get();

            //if ($notice_list) {

            $response['status'] = 'success';
            $response['message'] = '';
            $response['api_info']    = $notice_list;
            return response()->json($response);
            //return response()->json(['status' => 'success', 'message' => Lang::get('Data Successfully Updated')]);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Token Mismatch']);
        }
    }
}
