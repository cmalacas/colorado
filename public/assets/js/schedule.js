const Schedule = {
    init() {
        $('table.schedule tbody a.btn-edit').on('click', Schedule.edit);
        $('#schedule-table-modal .modal-footer .btn-primary').on('click', Schedule.submit);
    },

    submit() {

        const data = $('#schedule-table-modal form').serialize();

        $.ajax( {
            url: '/production-orders/save-schedule',
            type: 'post',
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: () => {
                $('#schedule-table-modal').modal('hide');
            }
        })

        
    },

    strMatcher(strs) {
        
        return function findMatches(q, cb) {
          
            var matches, substringRegex;
    
            matches = [];
    
            substrRegex = new RegExp(q, 'i');
    
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });
    
            cb(matches);
        };
    },

    edit() {
       const id = $(this).data('id');

        $.ajax( {
            url: `/production-orders/${id}/info`,
            type: 'get',
            dataType: 'json',
            success: (response) => {

                $('#schedule-table-modal .modal-title').html(response.title);

                $('#schedule-table-modal .modal-body').html(response.html);

                $('#schedule-table-modal .date').datepicker({dateFormat: "mm-dd-yy"});
         
                const locations = ['W/F Stock','W/F PC Stock','W/F Proof','W/F Neg','Folding','Jet','Cutting','Latex/PS','Straight Knife','Complete'];

                const foldingSchedule = ['RA-1', 'RA-2', 'RA-3', 'WR-1', 'WR-2', 'WR-3', 'MOW', 'MO', 'SO', '3 inch - 1', '3 inch - 2', '3 inch - 3', '3 inch - 4'];
 
                $( "#schedule-table-modal input[name=Location]" ).typeahead(
                    {
                        minLength: 0,
                    },
                    {
                        limit: 99,
                        name: 'unitFigure',
                        source: Schedule.strMatcher(locations)
                    }
                );

                $( "#schedule-table-modal input[name=FoldingScheduleStatus]" ).typeahead(
                    {
                        minLength: 0,
                    },
                    {
                        limit: 99,
                        name: 'unitFigure',
                        source: Schedule.strMatcher(foldingSchedule)
                    }
                )

                $('#schedule-table-modal').modal('show');
            }
        });

    },
}

$(document).ready(function() {
    Schedule.init();
})