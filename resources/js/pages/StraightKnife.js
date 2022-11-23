import React, { Component, Fragment } from 'react';
import Authservice from '../components/Authservice';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import cellEditFactory, { Type } from 'react-bootstrap-table2-editor';
import { counter } from '@fortawesome/fontawesome-svg-core';

import { Input } from 'reactstrap';

import { Number } from './FoldingSchedule';

export default class StraightKnife extends Component {

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

    }

    save( oldvalue, newvalue, row, column) {

        console.log('newvalue', newvalue);

        const data = this.state.data.map( d => {

            if ( d.id === row.id ) {

                if (column.dataField === 'customer') {

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

        Authservice.getStraightKnifeData()
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

            d.customer = customer.length > 0 ? customer[0].name : '';

            return d;

        });

        const customers = this.state.customers.map( c => {

            return { value: c.id, label: c.name }

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
                    dataField: 'SizeDimension2',
                    text: 'Sz1'
                },
                {
                    dataField: 'Description',
                    text: 'Description',
                    editor: {
                        type: Type.SELECT,
                        options: descriptions
                    }
                },
                {
                    dataField: 'FoldingDue',
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
                    dataField: 'Printing',
                    text: 'Prg',
                    editor: {
                        type: Type.SELECT,
                        options: printings
                    }
                },
                {
                    dataField: 'Location',
                    text: 'Location',
                    editor: {
                        type: Type.SELECT,
                        options: locations
                    }
                },
                {
                    dataField: 'StockDueIn',
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
                    dataField: 'DateDue',
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
                    dataField: 'StraightKnifeScheduleStatus',
                    text: 'Status'
                },
                {
                    dataField: 'StraightKnifeOrder',
                    text: 'Order',
                    editorRenderer :  ( editorProps, value, row, rowIndex, columnIndex ) => (
                        <Number { ...editorProps } value={ value } />
                    ),
                },
                {
                    dataField: 'JobTitle',
                    text: 'Job Title'
                },
                {
                    dataField: 'ship_via',
                    text: 'SHIPVIA',
                    editor: {
                        type: Type.CHECKBOX,
                        value: '1:0'
                    }
                }
        ];        

        return (

            <Fragment>
                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">{`Folding Scheduled - ${machine.machine}`}</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">{`Folding Scheduled - ${machine.machine}`}</li>
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

