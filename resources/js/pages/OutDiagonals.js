import React, { Component, Fragment } from 'react';

import {Row, Col, Card, Button, CardBody, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Input, Label} from 'reactstrap';

import { buildTable, Pager } from '../components/Functions';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faTrash, faSave, faBan, faEdit, faPlus } from '@fortawesome/free-solid-svg-icons';

import Authservice from '../components/Authservice';

import Swal from 'sweetalert2';

export default class OutDiagonals extends Component {

    constructor( props ) {

        super( props );

        this.state = {
            data: [],
            page: 1,
            limit: 25,
            search: '',
            field: 'any'
        }

        this.getData = this.getData.bind(this);
        this.pager = this.pager.bind(this);
        this.pagerSelect = this.pagerSelect.bind(this);
        this.save = this.save.bind(this);
        this.delete = this.delete.bind(this);
        this.add = this.add.bind(this);
        this.search = this.search.bind(this);
        this.select = this.select.bind(this);
    }

    select( e ) {

        this.setState( { field: e.target.value } );

    }

    search( e ) {

        this.setState( { search: e.target.value } );

    }

    add( data ) {

        Authservice.addOutDiagonal( data )
        .then( response => {

            if (response.outDiagonals) {        
                this.setState( { data: response.outDiagonals } );
            }         

        })

    }

    delete( data ) {

        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete this`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) {           
                Authservice.deleteOutDiagonal( { id: data.id }  )
                .then( response => {
                    if (response.outDiagonals) {        
                        this.setState( { data: response.outDiagonals } );
                    }         
                })
            }
        })  

    }

    save( data ) {

        Authservice.saveOutDiagonals( data )
        .then( response => {

            if (response.outDiagonals) {

                this.setState( { data: response.outDiagonals } );

            }

        })

    }

    pager( page ) {

        this.setState( { page } );

    }

    pagerSelect( e ) {

        this.pager( parseInt( e.target.value ) );

    }

    getData( data ) {

        Authservice.getOutDiagonals( data )
        .then( response => {

            if (response.outDiagonals) {

                this.setState( { data: response.outDiagonals } );

            }

        })
    }

    componentDidMount() {

        this.getData();

    }


    render() {

        const columns = [
            {
                dataField: 'index',
                text: '#',

            },
            {
                dataField: 'die_size',
                text: 'Die Size',

            },
            {
                dataField: 'sheet_size',
                text: 'Sheet / Roll Size',

            },
            {
                dataField: 'number_out',
                text: 'Number Out',

            },
            {
                dataField: 'die_number',
                text: 'Die Number',

            },
            {
                dataField: 'seal_flap_size',
                text: 'Seal Flap Size',

            },
            {
                dataField: 'actions',
                text: 'Actions',

            },
        ];

        const offset = ( this.state.page - 1 ) * this.state.limit;

        let counter = 0;

        const search = this.state.search.toString().toUpperCase().replace(/\s/g,'');

        const outs = this.state.data.filter( d => { 
            
            const die_size = d.die_size ? d.die_size.toString().toUpperCase().replace(/\s/g,'') : '';
            const sheet_size = d.sheet_size ? d.sheet_size.toString().toUpperCase().replace(/\s/g,'') : '';
            const die_number = d.die_number ? d.die_number.toString().toUpperCase().replace(/\s/g,'') : '';
            const number_out = d.number_out ? d.number_out.toString().toUpperCase().replace(/\s/g,'') : '';
            const seal_flap_size = d.seal_flap_size ? d.seal_flap_size.toString().toUpperCase().replace(/\s/g,'') : '';

            const field = this.state.field;

            if ( search === '' ) {

                return d;

            } else if ( field === 'any' ) {

                if ( die_number.indexOf( search ) >= 0 || 
                     die_size.indexOf( search ) >= 0 || 
                     sheet_size.indexOf( search ) >= 0 ||
                     number_out.indexOf( search ) >= 0 ||
                     seal_flap_size.indexOf( search ) >= 0 
                    ) {

                    return d;

                }

            } else if ( field === 'die_number' && die_number.indexOf( search ) >= 0 ) {

                return d;

            } else if ( field === 'die_size' && die_size.indexOf( search ) >= 0 ) {

                return d;

            } else if ( field === 'sheet_size' && sheet_size.indexOf( search ) >= 0 ) {

                return d;

            } else if ( field === 'number_out' && number_out.indexOf( search ) >= 0 ) {

                return d;

            } else if ( field === 'seal_flap_size' && seal_flap_size.indexOf( search ) >= 0 ) {

                return d;

            }
            

        } );


        const data = outs.filter( ( d, index ) => {

            if ( counter < this.state.limit && index >= offset) {

                d.index = index + offset + 1;

                counter += 1;

                d.actions = <Fragment>
                                <Edit save={this.save} data={ d } />
                                <Button onClick={ () => this.delete(d) } color="danger"><FontAwesomeIcon icon={faTrash} /> </Button>
                            </Fragment>

                return d;

            }

        });

        const table = buildTable(data, columns, false, false, false);

        const pager = Pager( this.state.page, outs.length, this.state.limit, this.pager, this.pagerSelect )

        return (

            <Fragment>
                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Diagonals</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Diagonals</li>
                            </ol>
                        
                        </div>
                    </div>
                </div>

                <Row>
                    <Col>
                    
                        <Card>
                            <CardBody>

                                <Row className="mb-3">
                                    <Col className="text-right d-flex justify-content-between">
                                        <FormGroup row className="mb-0">
                                            <Label sm={3}>Search: </Label>
                                            <Col sm={9} className="d-flex">
                                                <Input type="text" onChange={ this.search } className="mr-2" />
                                                <Input style={ { height: 'auto' } } type="select" onChange={ this.select }>
                                                    <option value="any">Any</option>
                                                    <option value="die_size">Die Size</option>
                                                    <option value="sheet_size">Sheet / Roll Size</option>
                                                    <option value="number_out">Number Out</option>
                                                    <option value="die_number">Die Number</option>
                                                    <option value="seal_flap_size">Seal Flap Size</option>
                                                </Input>
                                            </Col>                                            
                                        </FormGroup>
                                        <Row>
                                            <Col>
                                                <Add save={this.add} />
                                            </Col>
                                        </Row>
                                        
                                    </Col>
                                </Row>

                                { table }
                                { pager }
                                
                            </CardBody>
                        </Card>
                    
                    </Col>
                </Row>

            </Fragment>

        )

    }

}

class Add extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,

            id: 0,
            die_size: '',
            sheet_size: '',
            number_out: '',
            die_number: '',
            seal_flap_size: ''

        }        

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value } );

    }

    open( ) {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        this.props.save( this.state );
        this.close();

    }    

    render() {

        return (

            <Fragment>
                <Button  onClick={this.open} className="mr-1 mb-2" color="primary"><FontAwesomeIcon icon={faPlus} /> Add</Button>
                <Modal className="mw-100 w-50" isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>   
                        Edit
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Die Size</Label>
                            <Input name="die_size" value={this.state.die_size} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Sheet / Roll Size</Label>
                            <Input name="sheet_size" value={this.state.sheet_size} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Number Out</Label>
                            <Input name="number_out" value={this.state.number_out} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Die Number</Label>
                            <Input name="die_number" value={this.state.die_number} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Seal Flap Size</Label>
                            <Input name="seal_flap_size" value={this.state.seal_flap_size} onChange={this.change} />
                        </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success"><FontAwesomeIcon icon={faSave} /> Save</Button>
                        <Button onClick={this.close} color="light"><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }


}

class Edit extends Component {

    constructor( props ) {

        super( props );

        const data = props.data;

        this.state = {

            open: false,

            id: data.id,
            die_size: data.die_size,
            sheet_size: data.sheet_size,
            number_out: data.number_out,
            die_number: data.die_number,
            seal_flap_size: data.seal_flap_size

        }        

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value } );

    }

    open( ) {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        this.props.save( this.state );
        this.close();

    }

    componentDidUpdate() {

        const data = this.props.data;

        if (data.id !== this.state.id) {

            this.setState( {
                id: data.id,
                die_size: data.die_size,
                sheet_size: data.sheet_size,
                number_out: data.number_out,
                die_number: data.die_number,
                seal_flap_size: data.seal_flap_size
            })

        }

    }

    render() {

        return (

            <Fragment>
                <Button  onClick={this.open} className="mr-1" color="primary"><FontAwesomeIcon icon={faEdit} /></Button>
                <Modal className="mw-100 w-50" isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>   
                        Edit
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Die Size</Label>
                            <Input name="die_size" value={this.state.die_size} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Sheet / Roll Size</Label>
                            <Input name="sheet_size" value={this.state.sheet_size} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Number Out</Label>
                            <Input name="number_out" value={this.state.number_out} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Die Number</Label>
                            <Input name="die_number" value={this.state.die_number} onChange={this.change} />
                        </FormGroup>
                        <FormGroup>
                            <Label>Seal Flap Size</Label>
                            <Input name="seal_flap_size" value={this.state.seal_flap_size} onChange={this.change} />
                        </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success"><FontAwesomeIcon icon={faSave} /> Save</Button>
                        <Button onClick={this.close} color="light"><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }


}