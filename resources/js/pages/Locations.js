import React, { Component, Fragment } from 'react';

import {Row, Col, Card, Button, CardBody, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Input, Label} from 'reactstrap';

import { buildTable, Pager } from '../components/Functions';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faTrash, faSave, faBan, faEdit, faPlus } from '@fortawesome/free-solid-svg-icons';

import Authservice from '../components/Authservice';

import Swal from 'sweetalert2';

export default class Locations extends Component {

    constructor( props ) {

        super( props )

        this.state = {

            locations: []

        }

        this.add = this.add.bind(this);

    }

    getData( data ) {

        Authservice.getLocations( data )
        .then( response => {

            if (response.locations) {

                this.setState( { locations: response.locations } );

            }

        })
    }

    componentDidMount() {

        this.getData();

    }

    add( data ) {

        Authservice.addLocation( data )
        .then( response => {

            if (response.locations) {        
                this.setState( { data: response.locations } );
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
                Authservice.deleteMachine( { id: data.id }  )
                .then( response => {
                    if (response.machines) {        
                        this.setState( { data: response.machines } );
                    }         
                })
            }
        })  

    }

    save( data ) {

        Authservice.saveLocation( data )
        .then( response => {

            if (response.locations) {

                this.setState( { locations: response.locations } );

            }

        })

    }

    render() {

        const data = this.state.locations.map( l => {

            l.actions = <Fragment>
                            <Edit location={ l } save={this.save} />
                            <Button color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                        </Fragment>

            return l;

        })

        const columns = [
                {
                    dataField: 'location',
                    text: 'Location'
                },
                {
                    dataField: 'actions',
                    text: 'Actions'
                }
            ];

        const table = buildTable( data, columns, false, false, false);        

        return (

            <Fragment>

                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Locations</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Locations</li>
                            </ol>
                        
                        </div>
                    </div>
                </div>

                <Row>
                    <Col>
                    
                        <Card>
                            <CardBody>

                                <Row>
                                    <Col className="text-right">
                                        <Add save={this.add}  />                                        
                                    </Col>
                                </Row>

                                { table }

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
            location: '',            
            errorLocation: false,
        }        

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorLocation: false  } );

    }

    open( ) {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        let valid = true;

        let errorLocation = false;

        const { location } = this.state;

        if (location === '') {

            errorLocation = true;
            valid = false;

        }

        if (valid) {

            this.props.save( this.state );
            this.close();

        } else {

            this.setState( { errorLocation } );

        }

    }    

    render() {

        return (

            <Fragment>
                <Button  onClick={this.open} className="mr-1 mb-2" color="primary"><FontAwesomeIcon icon={faPlus} /> Add</Button>
                <Modal className="mw-100 w-50" isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>   
                        Add New Location
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Location</Label>
                            <Input name="location" value={this.state.location} onChange={this.change} />
                            { this.state.errorLocation ? <div className="alert alert-danger">This is required</div> : '' }
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

        const data = props.location;

        this.state = {

            open: false,

            id: data.id,
            location: data.location,
            errorLocation: false

        }        

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorMachine: false  } );

    }

    open( ) {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        let valid = true;

        let errorLocation = false;

        const { location } = this.state;

        if (location === '') {

            errorLocation = true;
            valid = false;

        }

        if (valid) {

            this.props.save( this.state );
            this.close();

        } else {

            this.setState( { errorLocation } );

        }

    }

    componentDidUpdate() {

        const data = this.props.location;

        if (data.id !== this.state.id) {

            this.setState( {
                id: data.id,
                location: data.location,                
            })

        }

    }

    render() {

        return (

            <Fragment>
                <Button  onClick={this.open} className="mr-1" color="primary"><FontAwesomeIcon icon={faEdit} /></Button>
                <Modal className="mw-100 w-50" isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>   
                        Edit Location
                    </ModalHeader>
                    <ModalBody>
                    <FormGroup>
                            <Label>Location</Label>
                            <Input name="location" value={this.state.location} onChange={this.change} />
                            { this.state.errorLocation ? <div className="alert alert-danger">This is required</div> : '' }
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