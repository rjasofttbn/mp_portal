<script>
    $(function(){
        var area_id = $('#area_id').val();
        var accommodation_building_id = '{{ $editData['flats']->accommodation_building_id ?? 'null' }}';
        var flat_id = '{{ $editData->flat_id ?? 'null' }}';

        if (area_id) {
            getBuildingByArea(area_id);
        }

        $(document).on('change','#area_id', function(){
            var area_id = $(this).val();
            getBuildingByArea(area_id);
        });

        function getBuildingByArea(area_id) {
            $.ajax({
                url: "{{ route('accommodationBuildingListByAreaId') }}",
                data: {area_id : area_id},
                type: "GET",
                dataType: "json",
                success:function(response){
                    var output = '<option value="">Select Building</option>';
                    $.each(response.data, function (k, val) {
                        output += '<option value="' + val.id + '">' + val.name + '</option>'
                    });
                    $('select[name="accommodation_building_id"]').html(output);
                    if (accommodation_building_id) {
                        $('#accommodation_building_id').val(accommodation_building_id).trigger('change');
                    }
                }
            });
        }
        
        $(document).on('change','#accommodation_building_id', function(){
            var accommodation_building_id = $(this).val();
            getFlatByBuilding(accommodation_building_id);
        });

        function getFlatByBuilding(accommodation_building_id) {
            $.ajax({
                url: "{{ route('flatsListByBuildingId') }}",
                data: {accommodation_building_id : accommodation_building_id},
                type: "GET",
                dataType: "json",
                success:function(response){
                    var output = '<option value="">Select flat</option>';
                    $.each(response.data, function (k, val) {
                        output += '<option value="' + val.id + '">' + val.name + '</option>'
                    });
                    $('select[name="flat_id"]').html(output);
                    if (flat_id) {
                        $('#flat_id').val(flat_id).trigger('change');
                    }
                }
            });
        }
    });
</script>