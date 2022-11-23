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

export default class JetUnscheduled extends Component {

    constructor( props ) {

        super( props )

        this.state = {

            data: [],
            customers: [],
            descriptions: [],
            printings: [],
            locations: [],
            statuses: [],

            rowStatus: 'collapse'

        }

        this.getData = this.getData.bind( this );
        this.save = this.save.bind( this );
        this.expand = this.expand.bind(this);
    }

    expand() {

        this.setState( { rowStatus: this.state.rowStatus === 'collapse' ? 'expand' : 'collapse' } );

    }

    getData( data ) {

        Authservice.getJetUnscheduled( data )
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

    componentDidMount() {

        this.getData();

    }

    save( oldvalue, newvalue, row, column) {

        const data = this.state.data.map( d => {

            if ( d.id === row.id ) {

                if (column.dataField === 'customer_id') {

                    row.CustomerId = parseInt(newvalue);

                }

                d = row;                
            }            

            return d;

        });

        this.setState( { data } );

        Authservice.saveJetSchedule( row );

    }

    render() {

        const data = this.state.data.map( d => {

            const customer = this.state.customers.filter( c => c.id === d.CustomerId );

            d.customer_id = customer.length > 0 ? customer[0].name : '';

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
                editable: false
            },
            {   
                dataField:'QtyNeeded',
                text: 'Qty',
                editable: false
            },
            {   
                dataField:'SizeDimension1',
                text: 'Sz 1',
                editable: false
            },
            {   
                dataField:'SizeDimension2',
                text: 'Sz 2',
                editable: false
            },
            {   
                dataField:'Description',
                text: 'Description',
                editable: false
            },
            {   
                dataField:'JetDue',
                text: 'Due',
                editable: false,
                formatter: (cell) => {

                    const dates = cell.split('-');

                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                },
            },
            {   
                dataField:'Printing',
                text: 'Prtg',
                editable: false
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
                dataField:'StockDueIn',
                text: 'Stk Due',
                formatter: (cell) => {

                    const dates = cell.split('-');

                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                },
                editable: false
            },
            {   
                dataField:'DateDue',
                text: 'Date Due',
                formatter: (cell) => {

                    const dates = cell.split('-');

                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                },
                editable: false
            },
            {   
                dataField:'JetScheduleStatus',
                text: 'Status',
                editor: {
                    type: Type.SELECT,
                    options: statuses
                }
            },
            {   
                dataField:'JetOrder',
                text: 'Order'
            },
            {   
                dataField:'JobTitle',
                text: 'Job Name',
                editable: false
            },
        ];

        return (

            <Fragment>

                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Jet Unscheduled</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Jet Unscheduled</li>
                            </ol>
                        
                        </div>
                    </div>
                </div>

                <Row className="mb-2">
                    <Col className="text-right">
                        <Button onClick={ this.expand } color="info" className="mr-1">Expand / Collapse</Button>
                        
                    </Col>
                </Row>

                <BootstrapTable 
                    keyField='id' 
                    columns={ columns } 
                    cellEdit={ cellEditFactory({ mode: 'click', blurToSave: true, afterSaveCell : this.save }) }
                    classes={ this.state.rowStatus === 'collapse' ? 'table-single-liner' : '' }
                    data={ data } striped hover />

            </Fragment>

        )

    }

}
