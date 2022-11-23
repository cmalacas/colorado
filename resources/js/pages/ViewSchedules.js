import React, { Fragment, Component } from 'react';

import { Card, CardBody, Row, Col, Button, Modal, ModalHeader, ModalFooter, ModalBody } from 'reactstrap';

import Authservice from '../components/Authservice';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faBan } from '@fortawesome/free-solid-svg-icons';

export default class ViewSchedules extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            machines: [],
            data: [],

        }

    }

    componentDidMount() {

        Authservice.getViewSchedulesData(  )
        .then( response => {

            if (response.machines) {

                this.setState( { 
                    machines: response.machines,     
                    data: response.results,               
                } );

            }

        });

    }


    render() {

        const machines = this.state.machines;

        const data = this.state.data;

        return (

            <Fragment>

                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">View Schedules</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">View Schedules</li>
                            </ol>                        
                        </div>
                    </div>
                </div>

                <Card>
                    <CardBody>

                        <Row>

                            <Col className="text-center" md={4}>

                                Jet

                                <Jet machines={ machines } data={ data } />

                            </Col>

                            <Col className="text-center" md={4}>

                                Folding

                                <Folding machines={ machines } data={ data } />

                            </Col>

                            <Col className="text-center" md={4}>

                                Straight Knife

                                <StraightKnife machines={ machines } data={ data } />

                            </Col>

                        </Row>

                    </CardBody>
                </Card>

            </Fragment>

        )

    }

}

class Jet extends Component {

    constructor( props ) {

        super( props );

    }

    render() {

        const machines = this.props.machines.filter( m => m.machine === 'Jet' );

        const columns = [
                            { 
                                dataField: 'id',
                                text: 'Job#'

                            },
                            {
                                dataField: 'SoldTo',
                                text: 'Customer'
                            },
                            {
                                dataField: 'QtyNeeded',
                                text: 'Qty'
                            },
                            {
                                dataField: 'Description',
                                text: 'Description'
                            },
                            {
                                dataField: 'SizeDimension1',
                                text: 'Sz1'
                            },
                            {
                                dataField: 'x',
                                text: 'x'
                            },
                            {
                                dataField: 'SizeDimension2',
                                text: 'Sz2'
                            },
                            {
                                dataField: 'Location',
                                text: 'Location'
                            },
                            {
                                dataField: 'StockDueIn',
                                text: 'Stk Due'
                            },
                            {
                                dataField: 'JetStock',
                                text: 'JetStock'
                            },
                            {
                                dataField: 'JobTitle',
                                text: 'Job Title'
                            },
                            {
                                dataField: 'DateDue',
                                text: 'Date Due'
                            },
                ];

        return (

            <div className="text-center mt-4 mb-4">

                {
                    machines.map( m => {

                        const data = this.props.data.filter( d => d.JetScheduleStatus === m.title )

                        return <div><Popup machine={ m } columns={ columns } data={ data }  /></div>

                    })
                }

            </div>

        )

    }

}

class Folding extends Component {

    constructor( props ) {

        super( props );

    }

    render() {

        const machines = this.props.machines.filter( m => m.machine != 'Jet' && m.machine != 'Straight Knife' );

        const columns = [
            { 
                dataField: 'id',
                text: 'Job#'

            },
            {
                dataField: 'SoldTo',
                text: 'Customer'
            },
            {
                dataField: 'QtyNeeded',
                text: 'Qty'
            },
            {
                dataField: 'Description',
                text: 'Description'
            },
            {
                dataField: 'SizeDimension1',
                text: 'Sz1'
            },
            {
                dataField: 'SizeDimension2',
                text: 'Sz2'
            },
            {
                dataField: 'StockDueIn',
                text: 'Stock Due'
            },
            {
                dataField: 'Printing',
                text: 'Print'
            },
            {
                dataField: 'Location',
                text: 'Location'
            },            
            {
                dataField: 'JobTitle',
                text: 'Job Title'
            },
            {
                dataField: 'DateDue',
                text: 'Date Due'
            },
        ];

        return (

            <div className="text-center mt-4 mb-4">

                {
                    machines.map( m => {

                        let data = [];

                        switch ( m.title ) {

                            case 'Latex / PS':

                                data = this.props.data.filter( d => d.Location === '8 Latex/PS' || 
                                                                    d.Machine1 === 'Latext / PS' ||
                                                                    d.Machine2 === 'Latext / PS' ||
                                                                    d.Machine3 === 'Latext / PS' ||
                                                                    d.Machine4 === 'Latext / PS' ||
                                                                    d.Machine5 === 'Latext / PS' )

                            break;

                            case 'MO':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '08 MO');

                            break;

                            case 'MOW':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '07 MOW');

                            break;

                            case 'RA-1':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '01 RA-1');

                            break;

                            case 'RA-2':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '02 RA-2');

                            break;

                            case 'RA-3':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '03 RA-3');

                            break;

                            case 'RA-WEB':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '10 RA-WEB');

                            break;

                            case 'RO-WEB':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '1 RO-WEB');

                            break;

                            case 'WR-1':

                                data = this.props.data.filter( d => d.FoldingScheduleStatus === '04 WR-1');

                            break;

                        }

                        return <div><Popup machine={ m } columns={ columns } data={ data } /></div>

                    })
                }

            </div>

        )

    }

}

class StraightKnife extends Component {

    constructor( props ) {

        super( props );

    }

    render() {

        const machines = this.props.machines.filter( m => m.machine === 'Straight Knife' );

        const columns = [
            { 
                dataField: 'id',
                text: 'Job#'

            },
            {
                dataField: 'SoldTo',
                text: 'Customer'
            },
            {
                dataField: 'QtyNeeded',
                text: 'Qty'
            },
            {
                dataField: 'Description',
                text: 'Description'
            },
            {
                dataField: 'SizeDimension1',
                text: 'Sz1'
            },
            {
                dataField: 'SizeDimension2',
                text: 'Sz2'
            },
            {
                dataField: 'StockDueIn',
                text: 'Stock Due'
            },
            {
                dataField: 'Printing',
                text: 'Print'
            },
            {
                dataField: 'Location',
                text: 'Location'
            },            
            {
                dataField: 'JobTitle',
                text: 'Job Title'
            },
            {
                dataField: 'DateDue',
                text: 'Date Due'
            },
        ];

        return (

            <div className="text-center mt-4 mb-4">

                {
                    machines.map( m => {

                        const data = this.props.data.filter( d => d.Location === '9 Straight Knife' || 
                                            d.Machine1 === m.title || 
                                            d.Machine2 === m.title || 
                                            d.Machine3 === m.title || 
                                            d.Machine4 === m.title || 
                                            d.Machine5 === m.title )

                        return <div><Popup machine={ m } columns={ columns } data={ data } /></div>

                    })
                }

            </div>

        )

    }

}

class Popup extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,
        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);

    }

    open( id ) {

        const win = window.open( `/open-schedule/${id}`, '_blank', 'width=999 height=999' );
        win.focus();
    }

    close() {
        this.setState( { open: false } );
    }

    render() {

        const machine = this.props.machine;

        return (

            <Fragment>

                <Button onClick={ () => this.open( machine.machine_id) } color="primary" className="w-50 mb-1">{machine.title}</Button>
                {/* <Modal isOpen={this.state.open} toggle={this.close} className="mw-100" style={ { width: '80%'} }>
                    <ModalHeader>
                        {machine.title}
                    </ModalHeader>
                    <ModalBody>

                    <BootstrapTable 
                        keyField='id' 
                        columns={ columns }                     
                        data={ data } striped hover />

                    </ModalBody>
                    <ModalFooter>
                        <Button color="light" onClick={ this.close }><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal> */}

            </Fragment>

        )

    }

}