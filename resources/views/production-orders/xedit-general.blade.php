<div class="wrapper p-4">
    <div class="row">
        <div class="col col-md-6">

            @component('ui.inputs.checkbox', 
                ['name' => 'Invoiced', 
                'class' => 'form-control', 
                'placeholder' => 'Invoiced',
                'tabindex' => 19,
                'value' => isset($data['Invoiced']) ? $data['Invoiced'] : ''
                ])
            @endcomponent

                    @component('ui.inputs.text', 
                        ['name' => 'id', 
                        'class' => 'form-control', 
                        'placeholder' => 'Colorado Env Prod Order',
                        'readonly' => 'true',
                        'tabindex' => 0,
                        'value' => isset($data['id']) ? $data['id'] : 0
                        ]),
                    @endcomponent

                    @component('ui.inputs.text', 
                        ['name' => 'JobTitle', 
                        'class' => 'form-control', 
                        'placeholder' => 'Job Title',
                        'tabindex' => 2,
                        'value' => isset($data['JobTitle']) ? $data['JobTitle'] : ''
                        ])
                    @endcomponent

            <div class="row">
                <div class="col col-md-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    @component('ui.inputs.text', 
                        ['name' => 'OrderDate', 
                        'class' => 'form-control date', 
                        'placeholder' => 'Order Date',
                        'tabindex' => 4,
                        'value' => isset($data['OrderDate']) ? $data['OrderDate'] : date("m-d-Y")
                        ])
                    @endcomponent
                </div>
            </div>
            
            <div class="row">
                <div class="col col-md-12">
                    @component('ui.inputs.text', 
                        ['name' => 'PreviousOrder', 
                        'class' => 'form-control', 
                        'placeholder' => 'Previous Order #',
                        'tabindex' => 6,
                        'value' => isset($data['PreviousOrder']) ? $data['PreviousOrder'] : ''
                        ])
                    @endcomponent
                </div>
            </div>

            <div class="row">

                <div class="col col-md-12">

                    @component('ui.inputs.text', 
                        ['name' => 'CustPO', 
                        'class' => 'form-control', 
                        'placeholder' => 'Customer PO',
                        'tabindex' => 8,
                        'value' => isset($data['CustPO']) ? $data['CustPO'] : ''
                        ])
                    @endcomponent

                    @component('ui.inputs.text', 
                        ['name' => 'QuotedPrice', 
                        'class' => 'form-control', 
                        'placeholder' => 'Quoted Price',
                        'tabindex' => 10,
                        'value' => isset($data['QuotedPrice']) ? $data['QuotedPrice'] : ''
                        ])
                    @endcomponent
                    
                    @component('ui.inputs.text', 
                        ['name' => 'UnitFigure', 
                        'class' => 'form-control', 
                        'options' => $unitFigures,
                        'placeholder' => 'Unit',
                        'tabindex' => 12,
                        'value' => isset($data['UnitFigure']) ? $data['UnitFigure'] : ''
                        ])
                    @endcomponent

                    @component('ui.inputs.text', 
                    ['name' => 'AdditionalChg', 
                    'class' => 'form-control', 
                    'placeholder' => 'Additional Charges',
                    'tabindex' => 14,
                    'value' => isset($data['AdditionalChg']) ? $data['AdditionalChg'] : ''
                    ])
                @endcomponent

                @component('ui.inputs.text', 
                    ['name' => 'StockDueIn', 
                    'class' => 'form-control date', 
                    'placeholder' => 'Stock Due In',
                    'tabindex' => 15,
                    'value' => isset($data['StockDueIn']) ? $data['StockDueIn'] : ''
                    ])
                @endcomponent

                </div>

            </div>

        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col">

                    <div class="form-group row">

                        <label class="col-md-3 text-right">Sold To</label>

                        <div class="col-md-7">

                            <select tabindex="1" name="CustomerId" class="form-control">
                                <option value="0">----</option>
                                @foreach($customers as $customer)

                                    @if (isset($data['CustomerId']) && $data['CustomerId'] == $customer['id'])

                                    <option selected="selected" value={{ $customer['id'] }}>{{ $customer['name'] }}</option>

                                    @else

                                    <option value={{ $customer['id'] }}>{{ $customer['name'] }}</option>

                                    @endif

                                @endforeach
                            </select>

                        </div>

                        <a data-toggle="tooltip" title="Select customer" href="#" class="btn btn-primary btn-customer"><i class="fa fa-users"></i></a>


                    </div>
                    
                    
                    {{--
                    @component('ui.inputs.select', 
                        ['name' => 'CustomerId', 
                        'class' => 'form-control with-plus', 
                        'options' => $customers,
                        'placeholder' => 'Sold To',
                        'default' => '---',
                        'value' => isset($data['CustomerId']) ? $data['CustomerId'] : '',
                        'plus' => '<a data-toggle="tooltip" title="Select customer" href="#" class="btn btn-primary btn-customer"><i class="fa fa-users"></i></a>'
                        ])
                    @endcomponent

                    --}}

                    @component('ui.inputs.text', 
                        ['name' => 'ContactName', 
                        'class' => 'form-control', 
                        'placeholder' => 'Contact Name',
                        'help' => 'Type a keyword to search',
                        'tabindex' => 3,
                        'value' => isset($data['ContactName']) ? $data['ContactName'] : ''
                        ])
                    @endcomponent

                    

                    @component('ui.inputs.text', 
                        ['name' => 'Email', 
                        'class' => 'form-control', 
                        'placeholder' => 'Email',
                        'tabindex' => 5,
                        'value' => isset($data['Email']) ? $data['Email'] : ''
                        ])
                    @endcomponent

                    @component('ui.inputs.text', 
                        ['name' => 'Phone', 
                        'class' => 'form-control', 
                        'placeholder' => 'Phone',
                        'tabindex' => 7,
                        'value' => isset($data['Phone']) ? $data['Phone'] : ''
                        ])
                    @endcomponent

                    @component('ui.inputs.text', 
                        ['name' => 'PhoneExt', 
                        'class' => 'form-control', 
                        'placeholder' => 'Phone Ext',
                        'tabindex' => 9,
                        'value' => isset($data['PhoneExt']) ? $data['PhoneExt'] : ''
                        ])
                    @endcomponent

                    @component('ui.inputs.text', 
                        ['name' => 'Mobile', 
                        'class' => 'form-control', 
                        'placeholder' => 'Mobile',
                        'tabindex' => 11,
                        'value' => isset($data['Mobile']) ? $data['Mobile'] : ''
                        ])
                    @endcomponent

                    @component('ui.inputs.text', 
                        ['name' => 'Fax', 
                        'class' => 'form-control', 
                        'placeholder' => 'Fax',
                        'tabindex' => 13,
                        'value' => isset($data['Fax']) ? $data['Fax'] : ''
                        ])
                    @endcomponent

                    {{-- @component('ui.inputs.text', 
                        ['name' => 'Alt', 
                        'class' => 'form-control', 
                        'placeholder' => 'Alt',
                        'value' => isset($data['Alt']) ? $data['Alt'] : ''
                        ])
                    @endcomponent

                    --}}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="col">

                @component('ui.inputs.text', 
                    ['name' => 'DateStockIn', 
                    'class' => 'form-control date', 
                    'placeholder' => 'Date Stock In',
                    'tabindex' => 16,   
                    'value' => isset($data['DateStockIn']) ? $data['DateStockIn'] : ''
                    ])
                @endcomponent

                @component('ui.inputs.text', 
                    ['name' => 'DateDue', 
                    'class' => 'form-control date', 
                    'placeholder' => 'Date Due',
                    'tabindex' => 18,
                    'value' => isset($data['DateDue']) ? $data['DateDue'] : ''
                    ])
                @endcomponent

                

                    @component('ui.inputs.checkbox', 
                                ['name' => 'SampleProv', 
                                 'class' => 'form-control', 
                                 'placeholder' => 'Sample Provided',
                                 'tabindex' => 20,
                                 'value' => isset($data['SampleProv']) ? $data['SampleProv'] : ''
                                ])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'Location', 
            'class' => 'form-control', 
            'options' => $locations,
            'placeholder' => 'Location',
            'tabindex' => 21,
            'value' => isset($data['Location']) ? $data['Location'] : ''
            ])
        @endcomponent

        

        @component('ui.inputs.text', 
            ['name' => 'our_stocks', 
            'class' => 'form-control', 
            'placeholder' => 'Our Stock',
            'tabindex' => 22,
            'value' => isset($data['our_stocks']) ? $data['our_stocks'] : ''
            ])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'customer_stocks', 
            'class' => 'form-control', 
            'placeholder' => 'Customer Stock',
            'tabindex' => 23,
            'value' => isset($data['customer_stocks']) ? $data['customer_stocks'] : ''
            ])
        @endcomponent

            </div>

        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col">
                    @component('ui.inputs.text', 
                        ['name' => 'ofCopies', 
                        'class' => 'form-control', 
                        'placeholder' => '# of Copies',
                        'tabindex' => 17,
                        'value' => isset($data['ofCopies']) ? $data['ofCopies'] : ''
                        ])
                    @endcomponent

                    

                    <div class="machine-involved p-3 border border-primary">

                    <h2>ROUTING</h2>

        @component('ui.inputs.text', 
            ['name' => 'Machine1', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 1',
            'tabindex' => 24,
            'value' => isset($data['Machine1']) ? $data['Machine1'] : ''
            ])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'Machine2', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 2',
            'tabindex' => 25,
            'value' => isset($data['Machine2']) ? $data['Machine2'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Machine3', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 3',
            'tabindex' => 26,
            'value' => isset($data['Machine3']) ? $data['Machine3'] : ''
            ])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'Machine4', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 4',
            'tabindex' => 27,
            'value' => isset($data['Machine4']) ? $data['Machine4'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Machine5', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 5',
            'tabindex' => 28,
            'value' => isset($data['Machine5']) ? $data['Machine5'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Machine6', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 6',
            'tabindex' => 29,
            'value' => isset($data['Machine6']) ? $data['Machine6'] : ''
            ])
        @endcomponent
        
        </div>

        <div class="mt-4">

        

        </div>

    </div>
    
</div>
        </div>

    </div>
</div>

