//This instruction for every return data

if (isApi()) {
	$data['status'] = 'success'; // use success or error text 
	$data['message'] = 'Data Saved successfully'; // sucess or error msg
	$response['api_info']    = $data; // return data
	return response()->json($response);
}

1. before data pass in blade file  [example = return view() or return response()->json()]

if (isApi()) {
	$response['api_info']    = $data; // return data
	return response()->json($response);
}
return view('home.blade.php',$data);
return response()->json($data);

2. before redirect path [example = return redirect()->back() or return redirect()->route()]

if (isApi()) {
	$data['status'] = 'success';
	$data['message'] = 'Data Saved successfully';
	return response()->json($response);
}
return redirect()->back()->with('success','Data successfully updated.');
return redirect()->route('');

3. data pass in blade file
 please do not use compact() or with() to pass data in blade file. requested to use like below instruction.

$data['source1'] = [];
$data['source2'] = [];
return view('home.blade.php',$data);