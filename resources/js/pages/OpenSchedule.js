import React, { Fragment, Component } from 'react';

import { Card, CardBody, CardHeader, Row, Col, Button, Modal, ModalHeader, ModalFooter, ModalBody } from 'reactstrap';

import Authservice from '../components/Authservice';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faPrint } from '@fortawesome/free-solid-svg-icons';

export default class OpenSchedule extends Component {

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

        const machine_id = this.props.match.params.id;

        const machine = this.state.machines.filter( m => m.machine_id === parseInt(machine_id) );

        

        return(

            <Fragment>

                { machine.length > 0 ? 

                    <Card className="mt-4 mb-4">

                        <CardHeader>
                            { machine[0].title }
                        </CardHeader>

                        <CardBody>

                            {
                                machine[0].title === 'Super Jet 1' || machine[0].title === 'Super Jet 2' ?

                                    <Jet machine={ machine[0] } data={ this.state.data } />

                                : 

                                machine[0].title === 'Straight Knife' ?

                                    <StraightKnife machine={ machine[0] } data={ this.state.data }  />

                                : 

                                    <Folding machine={ machine[0] } data={ this.state.data }  />
                            }

                        </CardBody>

                    </Card>

                : '' }

            </Fragment>

        )

    }

}

class Jet extends Component {

    constructor( props ) {

        super( props );

    }

    render() {

        const machine = this.props.machine;

        const data = this.props.data.filter( d => {

            if ( d.JetScheduleStatus === machine.title ) {

                d.x = 'x';

                return d;

            }
        
        } );

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
                                text: 'x',
                                classes: 'text-center pl-0 pr-0',
                                style: { width: '30px' },
                                headerStyle: { width: '30px' },
                                headerClasses: 'text-center pl-0 pr-0'
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
                                text: 'Stk Due',
                                formatter: (cell) => {

                                    const dates = cell.split('-');

                                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                                },
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
                                text: 'Date Due',
                                formatter: (cell) => {

                                    const dates = cell.split('-');

                                    return dates[1] + '-' + dates[2] + '-' + dates[0];

                                },
                            },
                ];

        return (

            <div className="text-center mt-4 mb-4">

                <Print machine={ machine } />

                <BootstrapTable 
                        keyField='id' 
                        columns={ columns }                     
                        data={ data } striped hover />

            </div>

        )

    }

}

class Folding extends Component {

    constructor( props ) {

        super( props );        

    }

    

    render() {

        const machine = this.props.machine;

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
                text: 'x',
                classes: 'text-center pl-0 pr-0',
                style: { width: '30px' },
                headerStyle: { width: '30px' },
                headerClasses: 'text-center pl-0 pr-0'
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

        let data = this.props.data.map( d => {

            d.x = 'x';

            return d;

        });

        switch ( machine.title ) {

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


        return (

            <div className="text-center mt-4 mb-4">

                <Print machine={ machine } />

                <BootstrapTable 
                        keyField='id' 
                        columns={ columns }                     
                        data={ data } striped hover />

            </div>

        )

    }

}

class Print extends Component {

    constructor( props ) {

        super( props );

        this.print = this.print.bind(this);

    }

    print() {

        const machine = this.props.machine;

        const win = window.open( `/folding-schedule/${machine.machine_id}/print`, '_blank');

        win.focus();

    }


    render() {

        return (

            <Row>

                <Col className="text-right"><Button onClick={ this.print } className="mb-2" color="primary"><FontAwesomeIcon icon={faPrint} /> Print</Button></Col>

            </Row>

        )

    }

}

class StraightKnife extends Component {

    constructor( props ) {

        super( props );

    }

    render() {

        const machine = this.props.machine;

        const data = this.props.data.filter( d => {

            if ( d.Location === '9 Straight Knife' || 
                d.Machine1 === machine.title || 
                d.Machine2 === machine.title || 
                d.Machine3 === machine.title || 
                d.Machine4 === machine.title || 
                d.Machine5 === machine.title )  {


                d.x = 'x';

                return d;

            }
            
        });

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
                text: 'x',
                classes: 'text-center pl-0 pr-0',
                style: { width: '30px' },
                headerStyle: { width: '30px' },
                headerClasses: 'text-center pl-0 pr-0'
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

                <Print machine={ machine } />

                <BootstrapTable 
                        keyField='id' 
                        columns={ columns }                     
                        data={ data } striped hover />

            </div>

        )

    }

}

