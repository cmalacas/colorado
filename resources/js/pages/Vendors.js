import React, { Component, Fragment } from 'react';
import { Card, CardBody, CardHeader, Button, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label, Input, Row, Col } from 'reactstrap';
import Authservice from '../components/Authservice';

import { buildTable, phone_number_check } from '../components/Functions';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

import { faUsers, faTrash, faEdit, faTextHeight } from '@fortawesome/free-solid-svg-icons';

export default class Vendors extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            vendors : [],
            contacts: []

        }

        this.getData = this.getData.bind(this);
        this.update = this.update.bind(this);
        this.save = this.save.bind(this);
        this.delete = this.delete.bind(this);
        this.updateContact = this.updateContact.bind(this);
        this.saveContact = this.saveContact.bind(this);
        this.deleteContact = this.deleteContact.bind(this);
    }

    deleteContact( data ) {

        Authservice.deleteVendorContacts( { id: data.id } )
        .then( response => {

            if (response.contacts) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    saveContact( data ) {

        Authservice.saveVendorContacts( data )
        .then( response => {

            if (response.contacts) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    updateContact( data ) {

        Authservice.updateVendorContacts( data )
        .then( response => {

            if (response.contacts) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    save( data ) {

        Authservice.saveVendor( data )
        .then( response => {

            if (response.vendors) {

                this.setState( { vendors: response.vendors } );

            }

        })

    }

    delete( data ) {

        Authservice.deleteVendor( { id: data.id } )
        .then( response => {

            if (response.vendors) {

                this.setState( { vendors: response.vendors } );

            }

        })

    }

    update( data ) {

        Authservice.updateVendor( data )
        .then( response => {

            if (response.vendors) {

                this.setState( { vendors: response.vendors } );

            }

        })

    }

    getData() {

        Authservice.getVendors()
        .then(response => {

            if (response.vendors) {

                this.setState( { vendors: response.vendors, contacts: response.contacts } );

            }

        })

    }

    componentDidMount() {

        this.getData();

    }

    render() {

        const columns = [ {
                            dataField: 'index',
                            text: '#'
                          },
                          {
                              dataField:'vendor',
                              text: 'Name'
                          },
                          {
                                dataField:'address',
                                text: 'Address'
                          },
                          {
                              dataField: 'actions',
                              text: 'Actions'
                          }
                        ];

        const data = this.state.vendors.map( (c,i) => {

            c.index = i + 1;

            const contacts = this.state.contacts.filter( cc => cc.vendor_id === c.id )

            c.actions = <Fragment>
                            <Edit vendor={ c } save={ this.update } />
                            <Contacts vendor={ c } contacts={ contacts } update={ this.updateContact } save={ this.saveContact } delete={ this.deleteContact } />
                            <Button onClick={ () => this.delete( c ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                        </Fragment>

            return c;

        })

        const table = buildTable( data, columns, false, false, false );

        return (

            <Fragment>
                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Vendors</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Vendors</li>
                            </ol>                        
                        </div>
                    </div>
                </div>

                <Card>
                    <CardHeader className="d-flex justify-content-between">
                        Vendors
                        <Add save={ this.save } />
                    </CardHeader>
                    <CardBody>
                        { table }
                    </CardBody>
                </Card>
            </Fragment>

        )

    }

}

export class Add extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            vendor: '',
            address: '',
            open: false,
            errorName: false,

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.save = this.save.bind(this);

    }

    open() {

        this.setState( { open: true } );

    }

    close() {
        this.setState( { open: false } );
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorName: false } );

    }

    save() {

        let valid = true;
        let errorName = false;

        const vendor = this.state.vendor;

        if ( vendor === '') {

            valid = false;
            errorName = true;

        }

        if (valid) {

            this.props.save( this.state );

            this.setState( { open: false, vendor: '' } );

        } else {

            this.setState( { errorName } );

        }


    }    

    render() {

        return (

            <Fragment>

                <Button data-tip="Add Vendor" onClick={this.open} color="primary" className="mr-1">{ this.props.icon ? <FontAwesomeIcon icon={this.props.icon} /> : `Add Vendor` }</Button>
                <Modal isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader className="d-flex justify-content-between">
                        Add Vendor
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>
                                Vendor
                            </Label>
                            <Input type="text" name="vendor" value={ this.state.vendor } onChange={ this.change } />
                            { this.state.errorName ? <div className="alert alert-danger">this is required</div> : '' }
                        </FormGroup>
                        <FormGroup>
                            <Label>
                                Address
                            </Label>
                            <Input type="textarea" name="address" value={ this.state.address } onChange={ this.change } />
                            
                        </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success">Save</Button>
                        <Button onClick={this.close} color="light">Cancel</Button>
                    </ModalFooter>
                </Modal>

            </Fragment>

        )

    }

}

class Edit extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            id: 0,
            vendor: '',
            address: '',
            open: false,
            errorName: false,

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.save = this.save.bind(this);

    }

    open() {

        this.setState( { open: true } );

    }

    close() {
        this.setState( { open: false } );
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorName: false } );

    }

    save() {

        let valid = true;
        let errorName = false;

        const vendor = this.state.name;

        if ( vendor === '') {

            valid = false;
            errorName = true;

        }

        if (valid) {

            this.props.save( this.state );

            this.setState( { open: false, vendor: '', address: '' } );

        } else {

            this.setState( { errorName } );

        }


    }

    componentDidUpdate() {

        if ( this.state.id !== this.props.vendor.id ) {

            this.setState( { id: this.props.vendor.id, vendor: this.props.vendor.vendor } );

        }

    }

    render() {

        return (

            <Fragment>

                <Button onClick={this.open} color="primary" className="mr-1"><FontAwesomeIcon icon={faEdit} /></Button>
                <Modal isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader className="d-flex justify-content-between">
                        Edit Vendor
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>
                                Vendor
                            </Label>
                            <Input type="text" name="vendor" value={ this.state.vendor } onChange={ this.change } />
                            { this.state.errorName ? <div className="alert alert-danger">this is required</div> : '' }
                        </FormGroup>
                        <FormGroup>
                            <Label>
                                Address
                            </Label>
                            <Input type="textarea" name="address" value={ this.state.address } onChange={ this.change } />
                            
                        </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success">Save</Button>
                        <Button onClick={this.close} color="light">Cancel</Button>
                    </ModalFooter>
                </Modal>

            </Fragment>

        )

    }

}

class Contacts extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    render() {

        const data = this.props.contacts.map( (c, i) => {

            c.index = i + 1;

            c.actions = <Fragment>
                            <EditContact contact={ c } save={ this.props.update } />
                            <Button onClick={ () => this.props.delete( c ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                        </Fragment>

            return c;

        })

        const columns = [
                            {
                                dataField: 'index',
                                text: '#'
                            },
                            {
                                dataField: 'name',
                                text: 'Name',
                            },
                            {
                                dataField: 'email',
                                text: 'Email',
                            },
                            {
                                dataField: 'phone',
                                text: 'Telephone'
                            },
                            {
                                dataField: 'phone_ext',
                                text: 'Telephone Ext'
                            },
                            {
                                dataField: 'fax',
                                text: 'Fax'
                            },
                            {
                                dataField: 'mobile',
                                text: 'Cellphone'
                            },
                            {
                                dataField: 'actions',
                                text: 'Actions'
                            }
                        ];

        const table = buildTable( data, columns, false, false, false );

        return (

            <Fragment>

                <Button onClick={this.open} color="primary" className="mr-1"><FontAwesomeIcon icon={faUsers} /></Button>
                <Modal isOpen={this.state.open} toggle={this.close} className="mw-100 w-75">
                    <ModalHeader>
                        Contacts
                    </ModalHeader>

                    <ModalBody>
                        <Row className="mb-4">
                            <Col className="d-flex justify-content-end"><AddContact save={ this.props.save } vendor_id={ this.props.vendor.id } /></Col>
                        </Row>

                        { table }
                    </ModalBody>
                    
                    <ModalFooter>
                        <Button onClick={this.close} color="light">Close</Button>
                    </ModalFooter>
                </Modal>
                
            </Fragment>

        )

    }

}

class EditContact extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,

            id: 0,
            vendor_id: 0,
            name: '',
            phone: '',
            phone_ext: '',
            fax: '',
            mobile: '',
            email: '',

            errorName : false,

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.changePhone = this.changePhone.bind(this);
        this.save = this.save.bind(this);

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorName: false  } );

    }

    changePhone( e ) {

        const value = phone_number_check( e );
        this.setState( { [e.target.name]: value, errorName: false  } );

    }

    save() {

        let valid = true;
        let errorName = false;

        const { name } = this.state;

        if ( name === '' ) {

            valid = false;
            errorName = true;

        }

        if (valid) {

            this.props.save( this.state );

            this.setState( { open: false });

        } else {

            this.setState( { errorName } );

        }

    }

    componentDidUpdate() {

        if ( this.state.id !== this.props.contact.id ) {

            const contact = this.props.contact;

            this.setState( { 
                    id: contact.id, 
                    name: contact.name, 
                    phone: contact.phone, 
                    phone_ext: contact.phone_ext, 
                    fax: contact.fax,
                    mobile: contact.mobile, 
                    email: contact.email,
                    vendor_id: contact.vendor_id
                } );

        }


    }

    render() {

        return (

            <Fragment>

                <Button onClick={ this.open } className="mr-1" color="primary"><FontAwesomeIcon icon={faEdit} /></Button>

                <Modal isOpen={ this.state.open } toggle={ this.close }>
                    <ModalHeader>
                        Edit Contact
                    </ModalHeader>
                    <ModalBody>

                        <FormGroup>
                            <Label>Name</Label>
                            <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                            { this.state.errorName ? <div className="alert alert-danger">this is required</div> : '' }
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone</Label>
                            <Input type="text" name="phone" value={ this.state.phone } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone Extension</Label>
                            <Input type="text" name="phone_ext" value={ this.state.phone_ext } onChange={ this.change } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Fax</Label>
                            <Input type="text" name="fax" value={ this.state.fax } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Cellphone</Label>
                            <Input type="text" name="mobile" value={ this.state.mobile } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Email</Label>
                            <Input type="text" name="email" value={ this.state.email } onChange={ this.change } />
                        </FormGroup>

                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={ this.save } color="success">Save</Button>
                        <Button onClick={ this.close } color="light">Cancel</Button>
                    </ModalFooter>
                </Modal>

            </Fragment>

        )

    }

}

class AddContact extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,

            id: 0,
            vendor_id: props.vendor_id,
            name: '',
            phone: '',
            phone_ext: '',
            fax: '',
            mobile: '',
            email: '',

            errorName : false,

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.changePhone = this.changePhone.bind(this);
        this.save = this.save.bind(this);

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorName: false  } );

    }

    changePhone( e ) {

        const value = phone_number_check( e );
        this.setState( { [e.target.name]: value, errorName: false  } );

    }

    save() {

        let valid = true;
        let errorName = false;

        const { name } = this.state;

        if ( name === '' ) {

            valid = false;
            errorName = true;

        }

        if (valid) {

            this.props.save( this.state );

            this.setState( { open: false, name: '', phone: '', phone_ext: '', email: '', fax: '', mobile: '' });

        } else {

            this.setState( { errorName } );

        }

    }

    render() {

        return (

            <Fragment>

                <Button onClick={ this.open } className="mr-1" color="primary">Add Contact</Button>

                <Modal isOpen={ this.state.open } toggle={ this.close }>
                    <ModalHeader>
                        Add Contact
                    </ModalHeader>
                    <ModalBody>

                        <FormGroup>
                            <Label>Name</Label>
                            <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                            { this.state.errorName ? <div className="alert alert-danger">this is required</div> : '' }
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone</Label>
                            <Input type="text" name="phone" value={ this.state.phone } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone Extension</Label>
                            <Input type="text" name="phone_ext" value={ this.state.phone_ext } onChange={ this.change } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Fax</Label>
                            <Input type="text" name="fax" value={ this.state.fax } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Cellphone</Label>
                            <Input type="text" name="mobile" value={ this.state.mobile } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Email</Label>
                            <Input type="text" name="email" value={ this.state.email } onChange={ this.change } />
                        </FormGroup>

                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={ this.save } color="success">Save</Button>
                        <Button onClick={ this.close } color="light">Cancel</Button>
                    </ModalFooter>
                </Modal>

            </Fragment>

        )

    }

}