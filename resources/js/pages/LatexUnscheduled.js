import React, { Component, Fragment } from 'react';

import {Row, Col, Card, Button, CardBody, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Input, Label} from 'reactstrap';

import { buildTable, Pager } from '../components/Functions';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faTrash, faSave, faBan, faEdit, faPlus } from '@fortawesome/free-solid-svg-icons';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import cellEditFactory, { Type } from 'react-bootstrap-table2-editor';


import Authservice from '../components/Authservice';

import Swal from 'sweetalert2';

export default class LatexUnscheduled extends Component {

    constructor( props ) {

        super( props )

        this.state = {

            data: [],
            customers: [],
            descriptions: [],
            printings: [],
            locations: [],
            statuses: []

        }

        this.getData = this.getData.bind( this );
        this.save = this.save.bind( this );
    }

    getData( data ) {

        Authservice.getLatexUnscheduled( data )
        .then( response => {

            if (response.data) {

                this.setState( { 
                    data: response.data, 
                    customers: response.customers, 
                    descriptions: response.descriptions,
                    printings: response.printings,
                    locations: response.locations,
                    statuses: response.statusses
                } );

            }

        })
    }

    save( oldvalue, newvalue, row, column) {

        const data = this.state.data.map( d => {

            if ( d.id === row.id ) {

                if (column.dataField === 'customer_id') {

                    row.CustomerId = parseInt(newvalue);

                }

                if (column.dataField === 'ship_via') {

                    row.SHIPVIA = parseInt(newvalue);

                }

                d = row;                
            }            

            return d;

        });

        this.setState( { data } );

        Authservice.saveLatexPsSchedule( row );

    }

    componentDidMount() {

        this.getData();

    }

    render() {

        const data = this.state.data.map( d => {

            const customer = this.state.customers.filter( c => c.id === d.CustomerId );

            d.customer_id = customer.length > 0 ? customer[0].name : '';
            d.ship_via = d.SHIPVIA === 1 ? 'Yes' : 'No';

            return d;

        });     
        
        const descriptions = this.state.descriptions.map( d => {

            return { value: d.description, label: d.description }

        });

        const printings = this.state.printings.map( p => {

            return { value: p.print, label: p.print }

        });

        const locations = this.state.locations.map( l => {

            return { value: l.location, label : l.location }

        });

        const statuses = this.state.statuses.map( s => {

            return { value: s.status, label: s.status }

        });

        const customers = this.state.customers.map( c => {

            return { value: c.id, label: c.name }

        });

        const columns = [
            {   
                dataField:'id',
                text: 'Job #'
            },
            {   
                dataField:'customer_id',
                text: 'Customer',
                editor: {
                    type: Type.SELECT,
                    options: customers
                }
            },
            {   
                dataField:'QtyNeeded',
                text: 'Qty'
            },
            {   
                dataField:'SizeDimension1',
                text: 'Sz 1'
            },
            {   
                dataField:'SizeDimension2',
                text: 'Sz 2'
            },
            {   
                dataField:'Description',
                text: 'Description',
                editor: {
                    type: Type.SELECT,
                    options: descriptions
                }
            },
            {   
                dataField:'FoldingDue',
                text: 'Due',
                formatter: (cell) => {

                    const dates = cell.split('-');

                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                },
                editor: {
                    type: Type.DATE
                }
            },
            {   
                dataField:'Printing',
                text: 'Prtg',
                editor: {
                    type: Type.SELECT,
                    options: printings
                }
            },
            {   
                dataField:'Location',
                text: 'Location',
                editor: {
                    type: Type.SELECT,
                    options: locations
                }
            },
            {   
                dataField:'FoldingScheduleStatus',
                text: 'Status',
                editor: {
                    type: Type.SELECT,
                    options: statuses
                }
            },
            {   
                dataField:'StockDueIn',
                text: 'Stk Due',
                formatter: (cell) => {

                    const dates = cell.split('-');

                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                },
                editor: {
                    type: Type.DATE
                }
            },
            {   
                dataField:'FoldingOrder',
                text: 'Order',
                editor: {
                    type: Type.NUMBER
                }
            },
            {   
                dataField:'DateDue',
                text: 'Date Due',
                formatter: (cell) => {

                    const dates = cell.split('-');

                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                },
                editor: {
                    type: Type.DATE
                }
            },
            {   
                dataField:'JobTitle',
                text: 'Job Title'
            },
            {   
                dataField:'ship_via',
                text: 'SHIP VIA',
                editor: {
                  type: Type.CHECKBOX,
                  value: '1:0'
                }
            },
        ];
                    

        return (

            <Fragment>

                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Latex / PS Unscheduled</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Latex / PS Unscheduled</li>
                            </ol>
                        
                        </div>
                    </div>
                </div>

                

                <BootstrapTable 
                    keyField='id' 
                    columns={ columns } 
                    cellEdit={ cellEditFactory({ mode: 'click', blurToSave: true, afterSaveCell : this.save }) }
                    data={ data } striped hover />

            </Fragment>

        )

    }

}
