import React, { Component, Fragment } from 'react';
import Authservice from '../components/Authservice';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import cellEditFactory, { Type } from 'react-bootstrap-table2-editor';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faPrint } from '@fortawesome/free-solid-svg-icons';

import { Row, Col, Button, Input } from 'reactstrap';

export default class FoldingSchedule extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            data: [],
            machine: { machine: '', id: 0 },
            descriptions:[],
            customers: [],
            locations: [],
            printings: [],
            statuses: [],
            jetStatuses: []

        }

        this.save = this.save.bind( this );
        this.doPrint = this.doPrint.bind( this );
    }

    doPrint() {

        const id = this.props.match.params.id;

        const w = window.open( '/folding-schedule/' + id + '/print', '_blank'  );

        w.focus();

    }

    save( oldvalue, newvalue, row, column) {

        const data = this.state.data.map( d => {

            if ( d.id === row.id ) {

                if (column.dataField === 'customer_id') {

                    row.CustomerId = parseInt(newvalue);

                }

                if ( column.dataField === 'ship_via' ) {

                    row.SHIPVIA = parseInt(newvalue);

                }

                d = row;                
            }            

            return d;

        });

        this.setState( { data } );

        Authservice.saveFoldingSchedule( row );

    }

    componentDidMount() {

        const id = this.props.match.params.id;

        Authservice.getFoldingScheduleData( { id } )
        .then( response => {

            if (response.data) {

                this.setState( { 
                    data: response.data, 
                    machine: response.machine,
                    customers: response.customers,
                    descriptions: response.descriptions,
                    locations: response.locations,
                    printings: response.printings,
                    statuses: response.statusses,
                    jetStatuses: response.jetStatuses
                } );

            }

        });

    }

    render() {

        const machine = this.state.machine;

        const data = this.state.data.map( d => {

            const customer = this.state.customers.filter( c => c.id === d.CustomerId );

            d.ship_via = d.SHIPVIA === 1 ? 'Yes' : 'No';

            d.x = 'x';

            d.customer = customer.length > 0 ? customer[0].name : '';

            return d;

        });

        let title = 'Converting Schedule';

        const customers = this.state.customers.map( c => {

            return { value: c.name, label: c.name }

        });

        const descriptions = this.state.descriptions.map( d => {

            return { value: d.description, label: d.description }

        })

        const printings = this.state.printings.map( p => {

            return { value: p.print, label: p.print }

        })

        const locations = this.state.locations.map( l => {

            return { value: l.location, label: l.location }

        })

        const statuses = this.state.statuses.map( s => {

            return { value: s.status, label: s.status }

        })

        const jet_statuses = this.state.jetStatuses.map( s => {

            return { value: s.status, label: s.status }

        })

        const columns = [
                {
                    dataField: 'id',
                    text: 'Job #'
                },
                {
                    dataField: 'customer',
                    text: 'Customer',
                    editor: {
                        type: Type.SELECT,
                        options: customers
                    }
                },
                {
                    dataField: 'QtyNeeded',
                    text: 'Qty'
                },
                {
                    dataField: 'SizeDimension1',
                    text: 'Sz1'
                },
                {
                    dataField: 'x',
                    text: 'x',
                    classes: 'text-center pl-0 pr-0',
                    style: { width: '30px' },
                    headerClasses: 'text-center pl-0 pr-0',
                    headerStyle: { width: '30px'},
                    align: 'center',
                    editable: false
                },
                {
                    dataField: 'SizeDimension2',
                    text: 'Sz2'
                },
                {
                    dataField: 'Description',
                    text: 'Description',
                    editor: {
                        type: Type.SELECT,
                        options: descriptions
                    }
                },
        ];

        const head_printing = {
                                    dataField: 'Printing',
                                    text: 'Prg',
                                    editor: {
                                        type: Type.SELECT,
                                        options: printings
                                    }
                                };

        const head_date_due = {
                                    dataField: 'DateDue',
                                    text: 'Date Due',
                                    editor: {
                                        type: Type.DATE
                                    }
                                };

        const head_folding_due = {
                                    dataField: 'FoldingDue',
                                    text: 'Due',
                                    editor: {
                                        type: Type.DATE
                                    }
                                };

        const head_location = {
                                    dataField: 'Location',
                                    text: 'Location',
                                    editor: {
                                        type: Type.SELECT,
                                        options: locations
                                    }
                                };

        const head_folding_schedule_status = {
                                    dataField: 'FoldingScheduleStatus',
                                    text: 'Status',
                                    editor: {
                                        type: Type.SELECT,
                                        options: statuses
                                    }
                                };
    
        const head_stock_due_in = {
                                    dataField: 'StockDueIn',
                                    text: 'Stk Due',
                                    editor: {
                                        type: Type.DATE
                                    }
                                };

        const head_folding_order = {
                                    dataField: 'FoldingOrder',
                                    text: 'Order',
                                    editorRenderer: ( editorProps, value, row, rowIndex, columnIndex ) => (
                                        <Number { ...editorProps } value={ value } />
                                    )
                                };

        const head_colors1 =    { 
                                    dataField: 'Colors1',
                                    text: 'Colors1'
                                };

        const head_colors2 =    {
                                    dataField: 'Colors2',
                                    text: 'Colors2'
                                };

        const head_colors3 =    {
                                    dataField: 'Colors3',
                                    text: 'Colors3'
                                };
                                
        const head_job_title =  {
                                    dataField: 'JobTitle',
                                    text: 'Job Title'
                                };
                                
        const head_ship_via =   {
                                    dataField: 'ship_via',
                                    text: 'SHIPVIA',
                                    editor: {
                                        type: Type.CHECKBOX,
                                        value: '1:0'
                                    }
                                };

        const head_jet_due = {
                                dataField: 'JetDue',
                                text: 'JetDue',
                                editor: {
                                    type: Type.DATE
                                }
                            };

        const head_jet_order = {
                                dataField: 'JetOrder',
                                text: 'JetOrder',
                                editorRenderer: ( editorProps, value, row, rowIndex, columnIndex ) => (
                                    <Number { ...editorProps } value={ value } />
                                )
                            };
        
        const head_jet_status = {
                                dataField: 'JetScheduleStatus',
                                text: 'Jet Schedule Status',
                                editor: {
                                    type: Type.SELECT,
                                    options: jet_statuses
                                }
                            }

        if (machine.machine === 'Latex / PS' || 
            machine.machine === 'RA-1' || 
            machine.machine === 'RA-2' || 
            machine.machine === 'RA-3' || 
            machine.machine === 'RA-WEB'  ||
            machine.machine === 'RO-WEB' ||
            machine.machine === 'WR-1' ||
            machine.machine === 'WR-2' ||
            machine.machine === 'WR-3' ||
            machine.machine === 'MO' ||
            machine.machine === 'MOW'
            ) {

            //columns.push( head_folding_due );
            columns.push( head_printing );
            columns.push( head_location );
            columns.push( head_folding_schedule_status );
            columns.push( head_stock_due_in );
            columns.push( head_folding_order );
            columns.push( head_date_due );
            columns.push( head_job_title );
            columns.push( head_ship_via );

            title += ` - ${machine.machine}`

            if (machine.machine === 'Latex / PS') {

                title = 'Latex / PS Schedule';

            }

        }

        if (machine.machine === 'Jet 3 inch-1' ||
            machine.machine === 'Jet 3 inch-2' ||
            machine.machine === 'Jet 3 inch-3' ||
            machine.machine === 'Jet 3 inch-4' ||
            machine.machine === 'Super Jet 1' ||
            machine.machine === 'Super Jet 2' ||
            machine.machine === 'Super Jet') {

            //columns.push( head_jet_due );
            columns.push( head_printing );
            columns.push( head_location );
            columns.push( head_stock_due_in );
            columns.push( head_jet_order );
            columns.push( head_jet_status );
            columns.push( head_job_title );
            columns.push( head_ship_via );

            title = `${machine.machine} Schedule`

        }

        
         /*       ,
                
            ]; */

        return (

            <Fragment>
                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">{ title }</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">{ title }</li>
                            </ol>                        
                        </div>
                    </div>
                </div>

                <Row className="mb-2">
                    <Col className="text-right">
                        <Button onClick={ this.doPrint } color="info"><FontAwesomeIcon icon={faPrint} /> Print</Button>
                    </Col>
                </Row>

                <BootstrapTable 
                    keyField='id' 
                    columns={ columns } 
                    cellEdit={ cellEditFactory({ mode: 'click', blurToSave: true, afterSaveCell : this.save }) }
                    data={ data } striped hover />

            </Fragment>

        )

    }

}

export class Number extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            value: props.value,

        }

        this.change = this.change.bind(this);

    }

    getValue() {

        return this.state.value;

    }

    componentDidMount() {

        this.setState( { value: this.props.value } );

    }

    change( e ) {

        this.setState( { value: parseInt(e.target.value) } );

    }

    render() {

        const value = this.state.value;

        return (

            <Input type="number" value={ value } onChange={ this.change } onBlur={ this.props.onBlur } />

        )

    }

}