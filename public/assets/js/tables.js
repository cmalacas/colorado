 const siteTables = {

    init() {

        $(document).on('submit', '.add-location-form', () => { return false } );
        $(document).on('submit', '.add-routing-form', () => { return false } );
        $(document).on('submit', '.add-gum-form', () => { return false } );
        $(document).on('submit', '.add-description-form', () => { return false } );
        $(document).on('submit', '.add-seal-form', () => { return false } );
        $(document).on('submit', '.add-tint-form', () => { return false } );
        $(document).on('submit', '.add-sides-form', () => { return false } );
        $(document).on('submit', '.add-ctn-size-form', () => { return false } );
        $(document).on('submit', '.add-stock-form', () => { return false } );
        $(document).on('submit', '.add-printing-form', () => { return false } );
        $(document).on('submit', '.add-schedule-form', () => { return false } );
        $(document).on('submit', '.add-jet-status-form', () => { return false } );
        $(document).on('submit', '.add-jet-stock-form', () => { return false } );

        $(document).on('submit', '.add-window-film-form', () => { return false } );

        $(document).on('submit', '.ship-to-form', () => { return false } );

        $(document).on('submit', '.window-size-form', () => { return false } );

        /* LOCATION */

        $(document).on('click', '.add-location-form .btn', siteTables.addLocation );

        $(document).on('click', '#location .btn-edit', function(){ siteTables.editLocation( this ) } );

        $(document).on('click', '#location .btn-save', function() { siteTables.saveLocation( this ) } );

        $(document).on('click', '#location .btn-delete', function() { siteTables.deleteLocation( this ) } )

        /* ROUTING */

        $(document).on('click', '.add-routing-form .btn', siteTables.addRouting );

        $(document).on('click', '#routing .btn-edit', function(){ siteTables.editRouting( this ) } );

        $(document).on('click', '#routing .btn-save', function() { siteTables.saveRouting( this ) } );

        $(document).on('click', '#routing .btn-delete', function() { siteTables.deleteRouting( this ) } )

        /* GUM */

        $(document).on('click', '.add-gum-form .btn', siteTables.addGum );

        $(document).on('click', '#type-of-gum .btn-edit', function(){ siteTables.editGum( this ) } );

        $(document).on('click', '#type-of-gum .btn-save', function() { siteTables.saveGum( this ) } );

        $(document).on('click', '#type-of-gum .btn-delete', function() { siteTables.deleteGum( this ) } )

        /* DESCRIPTION */

        $(document).on('click', '.add-description-form .btn', siteTables.addDescription );

        $(document).on('click', '#description .btn-edit', function(){ siteTables.editDescription( this ) } );

        $(document).on('click', '#description .btn-save', function() { siteTables.saveDescription( this ) } );

        $(document).on('click', '#description .btn-delete', function() { siteTables.deleteDescription( this ) } )

        /* SEAL */

        $(document).on('click', '.add-seal-form .btn', siteTables.addSeal );

        $(document).on('click', '#seal-flap .btn-edit', function(){ siteTables.editSeal( this ) } );

        $(document).on('click', '#seal-flap .btn-save', function() { siteTables.saveSeal( this ) } );

        $(document).on('click', '#seal-flap .btn-delete', function() { siteTables.deleteSeal( this ) } )

        /* TINT */

        $(document).on('click', '.add-tint-form .btn', siteTables.addTint );

        $(document).on('click', '#inside-tint-style .btn-edit', function(){ siteTables.editTint( this ) } );

        $(document).on('click', '#inside-tint-style .btn-save', function() { siteTables.saveTint( this ) } );

        $(document).on('click', '#inside-tint-style .btn-delete', function() { siteTables.deleteTint( this ) } )

        /* SIDES */

        $(document).on('click', '.add-sides-form .btn', siteTables.addSides );

        $(document).on('click', '#sides .btn-edit', function(){ siteTables.editSides( this ) } );

        $(document).on('click', '#sides .btn-save', function() { siteTables.saveSides( this ) } );

        $(document).on('click', '#sides .btn-delete', function() { siteTables.deleteSides( this ) } )

        /* CTN-SIZE */

        $(document).on('click', '.add-ctn-size-form .btn', siteTables.addCtnSize );

        $(document).on('click', '#ctn-size .btn-edit', function(){ siteTables.editCtnSize( this ) } );

        $(document).on('click', '#ctn-size .btn-save', function() { siteTables.saveCtnSize( this ) } );

        $(document).on('click', '#ctn-size .btn-delete', function() { siteTables.deleteCtnSize( this ) } )

        /* STOCK */

        $(document).on('click', '.add-stock-form .btn', siteTables.addStock );

        $(document).on('click', '#colo-stock .btn-edit', function(){ siteTables.editStock( this ) } );

        $(document).on('click', '#colo-stock .btn-save', function() { siteTables.saveStock( this ) } );

        $(document).on('click', '#colo-stock .btn-delete', function() { siteTables.deleteStock( this ) } )

        /* PRINTING */

        $(document).on('click', '.add-printing-form .btn', siteTables.addPrinting );

        $(document).on('click', '#printing .btn-edit', function(){ siteTables.editPrinting( this ) } );

        $(document).on('click', '#printing .btn-save', function() { siteTables.savePrinting( this ) } );

        $(document).on('click', '#printing .btn-delete', function() { siteTables.deletePrinting( this ) } )

        /* SCHEDULE */

        $(document).on('click', '.add-schedule-form .btn', siteTables.addSchedule );

        $(document).on('click', '#schedule .btn-edit', function(){ siteTables.editSchedule( this ) } );

        $(document).on('click', '#schedule .btn-save', function() { siteTables.saveSchedule( this ) } );

        $(document).on('click', '#schedule .btn-delete', function() { siteTables.deleteSchedule( this ) } )

        /* JET STATUS */

        $(document).on('click', '.add-jet-status-form .btn', siteTables.addJetStatus );

        $(document).on('click', '#jet-status .btn-edit', function(){ siteTables.editJetStatus( this ) } );

        $(document).on('click', '#jet-status .btn-save', function() { siteTables.saveJetStatus( this ) } );

        $(document).on('click', '#jet-status .btn-delete', function() { siteTables.deleteJetStatus( this ) } )

        /* JET STOCK */

        $(document).on('click', '.add-jet-stock-form .btn', siteTables.addJetStock );

        $(document).on('click', '#jet-stock .btn-edit', function(){ siteTables.editJetStock( this ) } );

        $(document).on('click', '#jet-stock .btn-save', function() { siteTables.saveJetStock( this ) } );

        $(document).on('click', '#jet-stock .btn-delete', function() { siteTables.deleteJetStock( this ) } )

        /* WINDOW FILM */

        $(document).on('click', '.add-window-film-form .btn', siteTables.addWindowFilm );

        $(document).on('click', '#window-film .btn-edit', function(){ siteTables.editWindowFilm( this ) } );

        $(document).on('click', '#window-film .btn-save', function() { siteTables.saveWindowFilm( this ) } );

        $(document).on('click', '#window-film .btn-delete', function() { siteTables.deleteWindowFilm( this ) } )

        /* SHIP TO */

        $(document).on('click', '.ship-to-form .btn', siteTables.shipTo );

        /* WINDOW SIZE */

        $(document).on('click', '.add-window-size-form .btn', siteTables.addWindowSize );

        $(document).on('click', '#window-size .btn-edit', function(){ siteTables.editWindowSize( this ) } );

        $(document).on('click', '#window-size .btn-save', function() { siteTables.saveWindowSize( this ) } );

        $(document).on('click', '#window-size .btn-delete', function() { siteTables.deleteWindowSize( this ) } )
       

    },

    /* LOCATION */

    saveLocation( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const location = $('input[name=location]', tr).val();

        let valid = true;

        if ( location === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-location',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.locations) {

                        $('.add-location-form input').val('');
                        $('#location table tbody').html( data.table );

                    }


                }

            })


        }

    },

    deleteLocation(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-location',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.locations) {

                    $('.add-location-form input').val('');
                    $('#location table tbody').html( data.table );

                }


            }

        })
       
    },

    editLocation(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="location" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    addLocation() {

        const params = $('.add-location-form').serialize();

        let valid = true;

        const location = $('.add-location-form input').val();

        if (location === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-location',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.locations) {

                        $('.add-location-form input').val('');
                        $('#location table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    /* ROUTING */

    saveRouting( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const machine = $('input[name=machine]', tr).val();

        let valid = true;

        if ( machine === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-routing',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.machines) {

                        $('.add-routing-form input').val('');
                        $('#routing table tbody').html( data.table );

                    }


                }

            })


        }

    },

    deleteRouting(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-routing',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.machines) {

                    $('#routing table tbody').html( data.table );

                }


            }

        })
       
    },

    editRouting(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="machine" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    addRouting() {

        const params = $('.add-routing-form').serialize();

        let valid = true;

        const machine = $('.add-routing-form input').val();

        if (machine === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-routing',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.machines) {

                        $('.add-routing-form input').val('');
                        $('#routing table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    /* GUM */

    saveGum( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const gum = $('input[name=gum]', tr).val();

        let valid = true;

        if ( gum === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-gum',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.gums) {

                        $('#type-of-gum table tbody').html( data.table );

                    }


                }

            })


        }

    },

    addGum() {

        const params = $('.add-gum-form').serialize();

        let valid = true;

        const gum = $('.add-gum-form input').val();

        if (gum === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-gum',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.gums) {

                        $('.add-gum-form input').val('');
                        $('#type-of-gum table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editGum(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="gum" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteGum(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-gum',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.gums) {

                    $('#type-of-gum table tbody').html( data.table );

                }


            }

        })
       
    },


    /* DESCRIPTION */

    saveDescription( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const description = $('input[name=description]', tr).val();

        let valid = true;

        if ( description === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-description',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.descriptions) {

                        $('#description table tbody').html( data.table );

                    }


                }

            })


        }

    },

    addDescription() {

        const params = $('.add-description-form').serialize();

        let valid = true;

        const description = $('.add-description-form input').val();

        if (description === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-description',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.descriptions) {

                        $('.add-description-form input').val('');
                        $('#description table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },


    editDescription(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="description" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteDescription(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');

        $.ajax( {

            url: '/tables/delete-description',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.descriptions) {

                    $('#description table tbody').html( data.table );

                }


            }

        })
       
    },

    /* SEAL */

    saveSeal( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const seal = $('input[name=sealFlap]', tr).val();

        let valid = true;

        if ( seal === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-seal',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.seals) {

                        $('#seal-flap table tbody').html( data.table );

                    }
                }
            })
        }
    },


    addSeal() {

        const params = $('.add-seal-form').serialize();

        let valid = true;

        const seal = $('.add-seal-form input').val();

        if (seal === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-seal',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.seals) {

                        $('.add-seal-form input').val('');
                        $('#seal-flap table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editSeal(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="sealFlap" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteSeal(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-seal',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.seals) {

                    $('#seal-flap table tbody').html( data.table );

                }


            }

        })
       
    },

    /* TINT */

    saveTint( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const style = $('input[name=style]', tr).val();

        let valid = true;

        if ( style === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-tint',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.tints) {

                        $('#inside-tint-style table tbody').html( data.table );

                    }


                }

            })


        }

    },


    addTint() {

        const params = $('.add-tint-form').serialize();

        let valid = true;

        const style = $('.add-tint-form input').val();

        if (style === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-tint',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.tints) {

                        $('.add-tint-form input').val('');
                        $('#inside-tint-style table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editTint(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="style" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteTint(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-tint',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.tints) {

                    $('#inside-tint-style table tbody').html( data.table );

                }


            }

        })
       
    },

    /* SIDES */

    saveSides( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const size = $('input[name=size]', tr).val();

        let valid = true;

        if ( size === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-sides',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.boxes) {

                        $('#sides table tbody').html( data.table );

                    }


                }

            })


        }

    },

    addSides() {

        const params = $('.add-sides-form').serialize();

        let valid = true;

        const size = $('.add-sides-form input').val();

        if (size === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-sides',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.boxes) {

                        $('.add-sides-form input').val('');
                        $('#sides table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editSides(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="size" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteSides(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-sides',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.boxes) {

                    $('#sides table tbody').html( data.table );

                }


            }

        })
       
    },

    /* CTN SIZE */

    saveCtnSize( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const size = $('input[name=size]', tr).val();

        let valid = true;

        if ( size === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-ctn-size',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.cartoons) {

                        $('#ctn-size table tbody').html( data.table );

                    }


                }

            })


        }

    },

    addCtnSize() {

        const params = $('.add-ctn-size-form').serialize();

        let valid = true;

        const size = $('.add-ctn-size-form input').val();

        if (size === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-ctn-size',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.cartoons) {

                        $('.add-ctn-size-form input').val('');
                        $('#ctn-size table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editCtnSize(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="size" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteCtnSize(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-ctn-size',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.cartoons) {

                    $('#ctn-size table tbody').html( data.table );

                }


            }

        })
       
    },

    /* STOCK */

    saveStock( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const size = $('input[name=size]', tr).val();

        let valid = true;

        if ( size === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-stock',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.stocks) {

                        $('#colo-stock table tbody').html( data.table );

                    }


                }

            })


        }

    },


    addStock() {

        const params = $('.add-stock-form').serialize();

        let valid = true;

        const size = $('.add-stock-form input').val();

        if (size === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-stock',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.stocks) {

                        $('.add-stock-form input').val('');
                        $('#colo-stock table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editStock(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="size" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteStock(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-stock',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.stocks) {

                    $('#colo-stock table tbody').html( data.table );

                }


            }

        })
       
    },

    /* PRINTING */

    savePrinting( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const print = $('input[name=print]', tr).val();

        let valid = true;

        if ( print === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-printing',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.prints) {

                        $('#printing table tbody').html( data.table );

                    }


                }

            })


        }

    },



    addPrinting() {

        const params = $('.add-printing-form').serialize();

        let valid = true;

        const print = $('.add-printing-form input').val();

        if (print === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-printing',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.prints) {

                        $('.add-printing-form input').val('');
                        $('#printing table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editPrinting(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="print" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deletePrinting(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-printing',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.prints) {

                    $('#printing table tbody').html( data.table );

                }


            }

        })
       
    },

    /* SCHEDULE STATUS */

    saveSchedule( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const status = $('input[name=status]', tr).val();

        let valid = true;

        if ( status === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-schedule',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.schedules) {

                        $('#schedule table tbody').html( data.table );

                    }


                }

            })


        }

    },

    addSchedule() {

        const params = $('.add-schedule-form').serialize();

        let valid = true;

        const status = $('.add-schedule-form input').val();

        if (status === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-schedule',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.schedules) {

                        $('.add-schedule-form input').val('');
                        $('#schedule table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editSchedule(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="status" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteSchedule(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-schedule',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.schedules) {

                    $('#schedule table tbody').html( data.table );

                }


            }

        })
       
    },

    /* JET SCHEDULE STATUS */

    saveJetStatus( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const status = $('input[name=status]', tr).val();

        let valid = true;

        if ( status === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-jet-status',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.jets) {

                        $('#jet-status table tbody').html( data.table );

                    }


                }

            })


        }

    },

    addJetStatus() {

        const params = $('.add-jet-status-form').serialize();

        let valid = true;

        const status = $('.add-jet-status-form input').val();

        if (status === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-jet-status',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.jets) {

                        $('.add-jet-status-form input').val('');
                        $('#jet-status table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editJetStatus(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="status" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteJetStatus(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-jet-status',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.jets) {

                    $('#jet-status table tbody').html( data.table );

                }


            }

        })
       
    },

    /* JET STOCK */

    saveJetStock( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const status = $('input[name=stock]', tr).val();

        let valid = true;

        if ( status === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-jet-stock',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.jet_stocks) {

                        $('#jet-stock table tbody').html( data.table );

                    }


                }

            })


        }

    },

    addJetStock() {

        const params = $('.add-jet-stock-form').serialize();

        let valid = true;

        const stock = $('.add-jet-stock-form input').val();

        if (stock === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-jet-stock',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.jet_stocks) {

                        $('.add-jet-stock-form input').val('');
                        $('#jet-stock table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editJetStock(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="stock" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteJetStock(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-jet-stock',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.jet_stocks) {

                    $('#jet-stock table tbody').html( data.table );

                }


            }

        })
       
    },


    addWindowFilm() {

        const params = $('.add-window-film-form').serialize();

        let valid = true;

        const stock = $('.add-window-film-form input').val();

        if (stock === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-window-film',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.films) {

                        $('.add-window-film-form input').val('');
                        $('#window-film table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editWindowFilm(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="film" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteWindowFilm(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-window-film',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.films) {

                    $('#window-film table tbody').html( data.table );

                }


            }

        })
       
    },

    saveWindowFilm( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const status = $('input[name=film]', tr).val();

        let valid = true;

        if ( status === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-window-film',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.films) {

                        $('#window-film table tbody').html( data.table );

                    }


                }

            })


        }

    },


    shipTo() {

        const params = $('.ship-to-form').serialize();

        let valid = true;

        const shipto = $('.ship-to-form textarea').val();

        if (shipto === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/ship-to',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                   


                }

            }) 

        }

        return false;

    },


    addWindowSize() {

        const params = $('.add-window-size-form').serialize();

        let valid = true;

        const size = $('.add-window-size-form input').val();

        if (size === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/add-window-size',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: params,
                success: (data) => {

                    if (data.windowSizes) {

                        $('.add-window-size-form input').val('');
                        $('#window-size table tbody').html( data.table );

                    }


                }

            }) 

        }

        return false;

    },

    editWindowSize(button) {

        const tr = $(button).parent().parent();

        const index = $(tr).data('index');
        const id = $(tr).data('id');
        const str = $(tr).data('text');

        const html = `<td>${index}</td><td><input type="hidden" name="id" value="${ id }" /><input type="text" class="form-control" name="size" value="${ str }" /></td><td><button class="btn btn-save btn-primary">Save</button></td>`;

        $(tr).html(html);

    },

    
    deleteWindowSize(button) {

        const tr = $(button).parent().parent();

        const id = $(tr).data('id');


        $.ajax( {

            url: '/tables/delete-window-size',
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: { id },
            success: (data) => {

                if (data.windowSizes) {

                    $('#window-size table tbody').html( data.table );

                }


            }

        })
       
    },

    saveWindowSize( button ) {

        const tr = $(button).parent().parent();

        const data = $('input', tr);

        const status = $('input[name=size]', tr).val();

        let valid = true;

        if ( status === '') {

            valid = false;

        } else {


            $.ajax( {

                url: '/tables/update-window-size',
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data,
                success: (data) => {

                    if (data.windowSizes) {

                        $('#window-size table tbody').html( data.table );

                    }


                }

            })


        }

    },


 }

 $(document).ready( function() {

    siteTables.init();

 })