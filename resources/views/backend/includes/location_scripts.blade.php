<script>
    $(function(){
        var division_id = $('#division_id').val();
        var district_id = "{{ $editData['constituency']->district_id ?? 'null' }}";
        var constituency_id = "{{ $editData->constituency_id ?? 'null' }}";

        if (division_id) {
            getDistrictByDivision(division_id);
        }

        $(document).on('change','#division_id', function(){
            var division_id = $(this).val();
            getDistrictByDivision(division_id);
        });

        function getDistrictByDivision(division_id) {
            $.ajax({
                url: "{{ route('districtListByDivisionId') }}",
                data: {division_id : division_id},
                type: "GET",
                dataType: "json",
                success:function(response){
                    var output = '<option value="">Select District</option>';
                    $.each(response.data, function (k, val) {
                        output += '<option value="' + val.id + '">' + val.name + '</option>'
                    });
                    $('select[name="district_id"]').html(output);
                    if (district_id) {
                        $('#district_id').val(district_id).trigger('change');
                    }
                }
            });
        }
        
        $(document).on('change','#district_id', function(){
            var district_id = $(this).val();
            getConstituencyByDistrict(district_id);
        });

        function getConstituencyByDistrict(district_id) {
            $.ajax({
                url: "{{ route('constituenciesListByDistrictId') }}",
                data: {district_id : district_id},
                type: "GET",
                dataType: "json",
                success:function(response){
                    var output = '<option value="">Select constituency</option>';
                    $.each(response.data, function (k, val) {
                        output += '<option value="' + val.id + '">' + val.name + '</option>'
                    });
                    $('select[name="constituency_id"]').html(output);
                    if (constituency_id) {
                        $('#constituency_id').val(constituency_id).trigger('change');
                    }
                }
            });
        }
    });
</script>