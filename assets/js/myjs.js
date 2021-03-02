
    $('#tanggalPenjemputan').datetimepicker({
        datepicker: true,
        timepicker: true,
        format: 'y-m-d H:i',
        minDate: 0,
        beforeShow: function() {
            $(this).datepicker('option', 'maxDate', $('#tanggalPengembalian').val());
            }
    });

    $('#tanggalPengembalian').datetimepicker({
        datepicker: true,
        timepicker: true,
        format: 'y-m-d H:i',
        minDate: 0,
        beforeShow: function() {
            $(this).datepicker('option', 'minDate', $('#tanggalPenjemputan').val());
                                    
        }
    });

    $('#waktuPenjemputan').datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'H:i',
        hours12: false,
        step: 30,
    })

    $('#waktuPengembalian').datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'H:i',
        hours12: false,
        step: 30,
    })


    $('#jam_buka').datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'H:i',
        hours12: false,
        step: 30,
    })

    $('#jam_tutup').datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'H:i',
        hours12: false,
        step: 30,
    })