import React, { Component, Fragment } from 'react';
import { Card, CardBody, CardHeader, Button, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label, Input, Row, Col, Nav, NavItem, NavLink, TabPane, TabContent } from 'reactstrap';
import Authservice from '../components/Authservice';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import cellEditFactory, { Type } from 'react-bootstrap-table2-editor';

import { buildTable, phone_number_check, phone_formatting, validateEmail } from '../components/Functions';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

import { faUsers, faTrash, faEdit, faPlus } from '@fortawesome/free-solid-svg-icons';

import ReactTooltip from 'react-tooltip';

import Swal from 'sweetalert2';

import { BrowserRouter as Router, Switch, Route, withRouter } from "react-router-dom";
import { connect } from 'react-redux';

import { setShippingData, getShippingData } from '../reducers/Shipping';

export class Customers extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            customers : [],
            contacts: [],
            shipping: [],
            search: '',

        }

        this.getData = this.getData.bind(this);
        this.update = this.update.bind(this);
        this.save = this.save.bind(this);
        this.updateContact = this.updateContact.bind(this);
        this.saveContact = this.saveContact.bind(this);
        this.deleteContact = this.deleteContact.bind(this);
        this.delete = this.delete.bind(this);
        this.search = this.search.bind(this);
    }

    search( e ) {

        this.setState( { search: e.target.value } );

    }

    delete( customer ) {

        const customers = this.state.customers.filter( c => c.id != customer.id );

        this.setState( { customers } );

        Authservice.deleteCustomer( { id: customer.id } )

    }

    saveContact( data ) {

        Authservice.saveContacts( data )
        .then( response => {

            if (response.contacts) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    deleteContact( data ) {        

        Authservice.deleteContacts( { id: data.id } )
        .then( response => {

            if (response.contacts) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    updateContact( data ) {

        Authservice.updateContacts( data )
        .then( response => {

            if (response.contacts) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    save( data ) {

        Authservice.saveCustomer( data )
        .then( response => {

            if (response.customers) {

                this.setState( { customers: response.customers, contacts: response.contacts } );

            }

        })

    }

    update( data ) {

        Authservice.updateCustomer( data )
        .then( response => {

            if (response.customers) {

                this.setState( { customers: response.customers, contacts: response.contacts } );

            }

        })

    }

    getData() {

        Authservice.getCustomers()
        .then(response => {

            if (response.customers) {

                this.props.setShippingData( response.shiptos );

                this.setState( { 
                    customers: response.customers, 
                    contacts: response.contacts,                    
                } );

                ReactTooltip.rebuild();

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
                              dataField:'name',
                              text: 'Name'
                          },
                          {
                              dataField: 'actions',
                              text: 'Actions'
                          }
                        ];

        const customers = this.state.customers.filter( c => {

            const search = this.state.search.toUpperCase();

            const string = `${c.name}`.toUpperCase();

            if ( this.state.search === '' || string.indexOf( search ) >= 0 ) {

                return c;

            }
            
        });

        // console.log('state', this.state);

        const data = customers.map( (c,i) => {

            c.index = i + 1;

            c.id = c.id;

            const contacts = this.state.contacts.filter( cc => cc.customer_id === c.id )
            const shipping = this.props.Shipping.length > 0 ? this.props.Shipping.filter( s => s.customer_id === c.id ) : [];

            // console.log('edit', shipping);

            c.actions = <Fragment>
                            <Edit  
                                customer={ c } 
                                save={ this.update }
                                contacts={ contacts }
                                shipping={ shipping }
                                saveShipping={ this.props.setShippingData }
                            />
                            <Contacts customer={ c } contacts={ contacts } save={ this.saveContact } update={ this.updateContact } delete={ this.deleteContact } />
                            <Button data-tip="Delete" onClick={ () => this.delete( c ) } title="Delete" color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                        </Fragment>

            return c;

        })

        const table = buildTable( data, columns, false, false, false );

        return (

            <Fragment>
                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Customers</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Customers</li>
                            </ol>                        
                        </div>
                    </div>
                </div>

                <Card>
                    <div className="card-header d-flex justify-content-between">

                        <h5>Customers</h5>

                        <div className="d-flex justify-content-between">
                            <Input onChange={ this.search } className="form-control mr-1" type="search" placeholder="Search" />
                            <Add save={ this.save } />
                        </div>

                    </div>
                    
                    <CardBody>
                        { table }
                    </CardBody>
                </Card>
                <ReactTooltip />
            </Fragment>

        )

    }

}

const mapStateToProp = state => ({
    
    Shipping: state.Shipping.shipping,

});

const mapDispatchToProps = dispatch => ({

    setShippingData: (data) => dispatch(setShippingData(data)),   
    getShippingData: (data) => dispatch(getShippingData(data)) 

});

export default withRouter(connect(mapStateToProp, mapDispatchToProps)(Customers));

class Add extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            name: '',
            open: false,
            errorName: false,
            contacts: [],
            counter: 0
        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.save = this.save.bind(this);
        this.add = this.add.bind(this);
        this.updateContact = this.updateContact.bind(this);
        this.removeContact = this.removeContact.bind(this);
    }

    removeContact( id ) {

        const contacts = this.state.contacts.filter( c => c.counter != id );

        this.setState( { contacts } );

    }

    updateContact( oldValue, newValue, row, column ) {

        const contacts = this.state.contacts.map( c => {

            if ( c.counter === row.counter ) {

                const field = column.dataField;

                if ( field === 'name' ) {

                    c.name = newValue;

                } else if ( field === 'email' ) {

                    c.email = newValue;

                } else if ( field === 'phone' ) {

                    c.phone = newValue;

                } else if ( field === 'fax' ) {

                    c.fax = newValue;

                } else if ( field === 'phone_ext' ) {

                    c.phone_ext = newValue;

                } else if ( field === 'mobile' ) {

                    c.mobile = newValue;

                }

            }


            return c;

        });

        this.setState( { contacts } );

    }

    add() {

        const counter = this.state.counter + 1;

        const actions = <Button data-tip="Delete" onClick={ () => this.removeContact( counter ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>

        const contact = { name: '', email: '', phone: '', phone_ext: '', mobile: '', fax: '', actions, counter };

        const contacts = this.state.contacts;

        contacts.push( contact );

        this.setState( { contacts, counter } );

    }

    open() {

        this.setState( { open: true  } );

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

        const name = this.state.name;

        if ( name === '') {

            valid = false;
            errorName = true;

        }

        if (valid) {

            this.props.save( this.state );

            this.setState( { open: false, name: '', contacts: [] } );

        } else {

            this.setState( { errorName } );

        }


    }    

    render() {

        const contacts = this.state.contacts

        const columns = [
                        {
                            dataField: 'name',
                            text: 'Name'
                        },
                        {
                            dataField: 'email',
                            text: 'Email',
                            validator: ( newValue, row, column ) => {

                                let valid = validateEmail( newValue );
                                const message = 'Email address is not valid';

                                return { valid, message }

                            }
                        },
                        {
                            dataField: 'phone',
                            text: 'Phone',
                            editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
                        },
                        {
                            dataField: 'phone_ext',
                            text: 'Phone Ext',
                            editorRenderer: ( editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneExt { ...editorProps } value={ value }  />
                        },
                        {
                            dataField: 'mobile',
                            text: 'Mobile',
                            editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
                        },
                        {
                            dataField: 'fax',
                            text: 'Fax',
                            editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
                        },
                        {
                            dataField: 'actions',
                            text: '',
                            editable: false
                        }
                    ];

        return (

            <Fragment>

                <Button onClick={this.open} color="primary" className="mr-1">Add Customer</Button>
                <Modal isOpen={this.state.open} toggle={this.close} className="mw-100 w-75">
                    <ModalHeader className="d-flex justify-content-between">
                        Add Customer
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup row>
                            <Col md={6}>
                                <Label>
                                    Customer
                                </Label>
                                <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                                { this.state.errorName ? <div className="alert alert-danger">this is required</div> : '' }
                            </Col>
                        </FormGroup>
                        <div className="d-flex justify-content-between">
                            <h2 style={ { fontSize: '18px' } }>Contacts</h2>
                            <span className="small text-danger">please click Save after you update the information</span>
                        </div>
                        <BootstrapTable 
                            keyField='counter' 
                            columns={ columns } 
                            cellEdit={ cellEditFactory({ mode: 'click', blurToSave: true, afterSaveCell : this.updateContact }) }
                            data={ contacts } striped hover />
                        <div className="text-right"><Button onClick={ this.add } color="primary"><FontAwesomeIcon icon={faPlus} /></Button></div>
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
            name: '',
            open: false,
            errorName: false,
            contacts: [],
            shipping: [],
            counter: 0,

            active: 'customer'
        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.save = this.save.bind(this);
        this.updateContact = this.updateContact.bind(this);
        this.add = this.add.bind(this);
        this.delete = this.delete.bind(this);
        this.deleteShipping = this.deleteShipping.bind(this);
    }

    deleteShipping( data ) {

        Authservice.deleteShipping( data )
        .then( response => {

            this.props.saveShipping( response.shipping );

        })
    }

    delete( counter ) {

        const contacts = this.state.contacts.filter( c => c.counter != counter );

        this.setState( { contacts } );

    }

    add() {

        const contacts = this.state.contacts;

        const counter = this.state.counter + 1;

        const actions = <Button color="danger" onClick={ () => this.delete( counter ) }><FontAwesomeIcon icon={faTrash} /></Button>

        const contact = { id: 0, name: '', email: '', phone: '', phone_ext: '', fax: '', counter, actions, mobile: '' }

        contacts.push( contact );

        this.setState( { contacts, counter } );

    }

    updateContact( oldValue, newValue, row, column ) {

        const contacts = this.state.contacts.map( c => {

            if ( c.counter === row.counter ) {

                const field = column.dataField;

                if ( field === 'name' ) {

                    c.name = newValue;

                } else if ( field === 'email' ) {

                    c.email = newValue;

                } else if ( field === 'phone' ) {

                    c.phone = newValue;

                } else if ( field === 'fax' ) {

                    c.fax = newValue;

                } else if ( field === 'phone_ext' ) {

                    c.phone_ext = newValue;

                } else if ( field === 'mobile' ) {

                    c.mobile = newValue;

                }

            }


            return c;

        });

        this.setState( { contacts } );

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

        const name = this.state.name;

        if ( name === '') {

            valid = false;
            errorName = true;

        }

        if (valid) {

            this.props.save( this.state );

            this.setState( { open: false } );

        } else {

            this.setState( { errorName } );

        }


    }

    componentDidUpdate() {

        if ( this.state.id !== this.props.customer.id ) {

            let counter = 0;

            const contacts = this.props.contacts.map( c => {

                c.counter = ++counter;
                c.actions = <Button color="danger" onClick={ () => this.delete( c.counter ) }><FontAwesomeIcon icon={faTrash} /></Button>

                return c;

            });

            const shipping = this.props.shipping;

            // console.log('shipping', this.props);

            this.setState( { 
                id: this.props.customer.id, 
                name: this.props.customer.name, 
                contacts,
                shipping,
                counter
            } );

        }

    }

    render() {

        const contacts = this.state.contacts;

        const shipping = this.props.shipping;

        const shippingColumns = [
                        {
                            dataField: 'shipto',
                            text: 'Name',
                        },
                        {
                            dataField: 'address1',
                            text: 'Address 1',
                        },
                        {
                            dataField: 'state',
                            text: 'State',
                        },
                        {
                            dataField: 'zip',
                            text: 'Zip'
                        },
                        {
                            dataField: 'attn',
                            text: 'Attn'
                        },
                        {
                            dataField: 'phone',
                            text: 'Phone'
                        },
                        {
                            dataField: 'action',
                            text: '',
                            formatter: (cell, row) => {

                                return <>
                                            <EditShipping 
                                                id={ row.id }
                                                shipping={ row }
                                                saveShipping={ this.props.saveShipping }
                                            />
                                            
                                            <Button className="ml-1" color="danger" onClick={ () => this.deleteShipping( { id: row.id } ) }>
                                                <FontAwesomeIcon icon={faTrash} />
                                            </Button>
                                        </>

                            }
                        }
                    ];

        const columns = [
                        {
                            dataField: 'name',
                            text: 'Name'
                        },
                        {
                            dataField: 'email',
                            text: 'Email',
                            validator: ( newValue, row, column ) => {

                                let valid = validateEmail( newValue );
                                const message = 'Email address is not valid';

                                return { valid, message }

                            }
                        },
                        {
                            dataField: 'phone',
                            text: 'Phone',
                            editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
                        },
                        {
                            dataField: 'phone_ext',
                            text: 'Phone Ext',
                            editorRenderer: ( editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneExt { ...editorProps } value={ value }  />
                        },
                        {
                            dataField: 'mobile',
                            text: 'Mobile',
                            editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
                        },
                        {
                            dataField: 'fax',
                            text: 'Fax',
                            editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
                        },
                        {
                            dataField: 'actions',
                            text: '',
                            editable: false
                        }
                    ];

        return (

            <Fragment>

                <Button data-tip="Edit" title="Delete" onClick={this.open} color="primary" className="mr-1"><FontAwesomeIcon icon={faEdit} /></Button>
                <Modal isOpen={this.state.open} toggle={this.close} className="mw-100 w-75">
                    <ModalHeader className="d-flex justify-content-between">
                        Edit Customer
                    </ModalHeader>
                    <ModalBody>
                        
                        <Nav tabs>
                            <NavItem>
                                <NavLink
                                    className={ this.state.active == 'customer' ? 'active' : '' }
                                    onClick={ () => this.setState({ active: 'customer' }) }
                                >
                                    Customer
                                </NavLink>
                            </NavItem>
                            <NavItem>
                                <NavLink
                                    className={ this.state.active == 'shipping' ? 'active' : '' }
                                    onClick={ () => this.setState({ active: 'shipping' }) }
                                >
                                    Shipping Address
                                </NavLink>
                            </NavItem>
                        </Nav>

                        <TabContent activeTab={ this.state.active }>
                            <TabPane tabId="customer">
                                <FormGroup row className="pt-2">
                                    <Col md={6}>
                                        <Label>
                                            Customer
                                        </Label>
                                        <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                                        { this.state.errorName ? <div className="alert alert-danger">this is required</div> : '' }
                                    </Col>
                                </FormGroup>

                                <div className="d-flex justify-content-between">
                                    <h2 style={ { fontSize: '18px' } }>Contacts</h2>
                                    <span className="small text-danger">please click Save after you update the information</span>
                                </div>

                                <BootstrapTable 
                                    keyField='counter' 
                                    columns={ columns } 
                                    cellEdit={ cellEditFactory(
                                            { 
                                                mode: 'click', 
                                                blurToSave: true, 
                                                afterSaveCell : this.updateContact 
                                            }) }
                                    data={ contacts } striped hover />
                                
                                
                                <div className="text-right"><Button onClick={ this.add } color="primary"><FontAwesomeIcon icon={faPlus} /></Button></div>

                            </TabPane>   

                            <TabPane tabId="shipping">
                                <Row className="m-2">
                                    <Col className="text-right">
                                        <AddShipping 
                                            customer_id={ this.state.id }
                                            shipping={ shipping }
                                            saveShipping={ this.props.saveShipping }
                                        />
                                    </Col>
                                </Row>

                                <BootstrapTable 
                                    keyField='counter' 
                                    columns={ shippingColumns }                                     
                                    data={ shipping } 
                                    striped 
                                    hover />
                            </TabPane>  
                        </TabContent>

                    </ModalBody>
                    <ModalFooter>
                        { this.state.active === 'customer' ?
                            
                            <Button onClick={this.save} color="success">Save</Button>

                        : '' }

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
                            <Button data-tip="Delete" color="danger" onClick={ () => this.props.delete(c) }><FontAwesomeIcon icon={faTrash} /></Button>
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

                <Button data-tip="Contacts" title="Contacts" onClick={this.open} color="primary" className="mr-1"><FontAwesomeIcon icon={faUsers} /></Button>
                <Modal isOpen={this.state.open} toggle={this.close} className="mw-100 w-75">
                    <ModalHeader>
                        Contacts
                    </ModalHeader>

                    <ModalBody>
                        <Row className="mb-4">
                            <Col className="d-flex justify-content-end"><AddContact save={ this.props.save } customer_id={ this.props.customer.id } /></Col>
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
            customer_id: 0,
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
                    customer_id: contact.customer_id
                } );

        }


    }

    render() {

        return (

            <Fragment>

                <Button data-tip="Edit" title="Edit" onClick={ this.open } className="mr-1" color="primary"><FontAwesomeIcon icon={faEdit} /></Button>

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
            customer_id: props.customer_id,
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

                <Button data-tip="Add" title="Add" onClick={ this.open } className="mr-1" color="primary">Add Contact</Button>

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

class PhoneFormatting extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            phone_number: props.value,

        }

        this.change = this.change.bind(this);
        this.getValue = this.getValue.bind(this);        
    }

    change( e ) {

        let phone_number;
        const number = e.target.value.replace(/\D/g,'');

        if ( number.length > 2 ) {

            phone_number = number.substring(0,3) + '-';

            if ( number.length === 4 ||  number.length === 5 ) {

                phone_number += number.substr(3);

            } else if ( number.length > 5 ) {

                phone_number += number.substring( 3, 6 ) + '-';

            }

            if ( number.length > 6 ) {

                phone_number += number.substring(6);

            }

        } else {

            phone_number = number;

        }

        this.setState( { phone_number } );

    }

    getValue() {

        return this.state.phone_number;

    }


    render() {

        const { value, onUpdate, ...rest } = this.props;

        return (

            <Fragment>
                <Input { ...rest } value={ this.state.phone_number } className="form-control" type="text" onChange={ this.change } onUpdate={ this.getValue }  />
            </Fragment>

        )

    }
}

class PhoneExt extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            phone_ext: props.value,

        }

        this.change = this.change.bind(this);
        this.getValue = this.getValue.bind(this);        
    }

    change( e ) {

        const phone_ext = e.target.value.replace(/\D/g,'');

        
        this.setState( { phone_ext } );

    }

    getValue() {

        return this.state.phone_ext;

    }


    render() {

        const { value, onUpdate, ...rest } = this.props;

        return (

            <Fragment>
                <Input { ...rest } value={ this.state.phone_ext } className="form-control" type="text" onChange={ this.change } onUpdate={ this.getValue }  />
            </Fragment>

        )

    }

}

class EditShipping extends Component {

    constructor( props ) {

        super( props );

        const shipping = props.shipping;

        const shipto = shipping.shipto;
        const address1 = shipping.address1;
        const address2 = shipping.address2;
        const city = shipping.city;
        const state = shipping.state;
        const phone = shipping.phone;
        const attn = shipping.attn;
        const zip = shipping.zip;

        const customer_id = shipping.customer_id;

        this.state = {
            id: props.id,
            open: false,

            shipto,
            address1,
            address2,
            city,
            state,
            phone,
            zip,
            phone,
            attn,
            customer_id
        }

        this.open = this.open.bind( this );
        this.close = this.close.bind( this );
        this.handleChange = this.handleChange.bind(this);
        this.save = this.save.bind(this);
        this.handleChangePhone = this.handleChangePhone.bind( this );

    }

    handleChangePhone( e ) {

        const value = phone_number_check( e );
        this.setState( { phone : value } );

    }

    save() {

        const { id, shipto, city, state, address1, address2, zip, phone, attn, customer_id } = this.state;

        const data = { id, shipto, city, state, zip, address1, address2, phone, attn, customer_id }

        Authservice.saveShipping(data)
        .then( response => {

   
            if (response.success) {

                Swal.fire({
                    title: 'Success!',
                    text: `Shipping address saved`,
                    icon: 'success',
                    showCancelButton: false,                    
                    confirmButtonColor: '#3085d6',
                })  

                this.props.saveShipping( response.shipping );

                this.close();

            }

        })

        

    }

    handleChange(e) {

        this.setState({ [e.target.name]: e.target.value });

    }

    open() {

        this.setState({ open: true });    

    }

    close() {

        this.setState({ open: false });

    }

    render() {

        return (

            <>
                <Button onClick={ this.open } color="primary">
                    <FontAwesomeIcon icon={faEdit} />
                </Button>
                <Modal isOpen={ this.state.open } toggle={ this.close } className="mw-100 w-50">
                    <ModalHeader>
                        Edit Shipping Address
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Name</Label>
                            <Input type="text" name="shipto" value={ this.state.shipto } onChange={ this.handleChange } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Address</Label>
                            <Input className="mb-1" type="text" name="address1" value={ this.state.address1 } onChange={ this.handleChange }  />
                            <Input type="text" name="address2" value={ this.state.address2 }  onChange={ this.handleChange }  />
                        </FormGroup>

                        <FormGroup row>
                            <Col>
                                <Label>City</Label>
                                <Input type="text" name="city" value={ this.state.city }  onChange={ this.handleChange }  />
                            </Col>

                            <Col>

                                <Label>State</Label>
                                <Input type="text" name="state" value={ this.state.state }  onChange={ this.handleChange }  />
                            
                            </Col>

                            <Col>

                                <Label>Zip</Label>
                                <Input type="text" name="zip" value={ this.state.zip }  onChange={ this.handleChange }  />
                            
                            </Col>
                            
                        </FormGroup>                        

                        <FormGroup>
                            <Label>Attn</Label>
                            <Input type="text" name="attn" value={ this.state.attn }  onChange={ this.handleChange }  />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone</Label>
                            <Input type="text" name="phone" value={ this.state.phone }  onChange={ this.handleChangePhone }  />
                        </FormGroup>

                    </ModalBody>
                    <ModalFooter>
                        <Button color="success" onClick={ this.save }>Save</Button>
                        <Button color="primary" onClick={ this.close }>Close</Button>
                    </ModalFooter>
                </Modal>
            </>

        )

    }

}

class AddShipping extends Component {

    constructor( props ) {

        super( props );

        const customer_id = props.customer_id;
        const shipping = props.shipping;

        this.state = {
            open: false,

            shipto: '',
            address1: '',
            address2: '',
            city: '',
            state: '',
            phone: '',
            zip: '',
            phone: '',
            attn: '',
            customer_id,
            shipping
        }

        this.open = this.open.bind( this );
        this.close = this.close.bind( this );
        this.handleChange = this.handleChange.bind(this);
        this.save = this.save.bind(this);
        this.handleChangePhone = this.handleChangePhone.bind(this);
    }

    handleChangePhone(e) {

        const value = phone_number_check( e );
        this.setState( { phone : value } );
    }

    save() {

        const { id, shipto, city, state, address1, address2, zip, phone, attn, customer_id } = this.state;

        let errorName = false;

        if (shipto != "") {

            const data = { id, shipto, city, state, zip, address1, address2, phone, attn, customer_id }

            Authservice.addShipping(data)
            .then( response => {

    
                if (response.success) {

                    Swal.fire({
                        title: 'Success!',
                        text: `Shipping address added`,
                        icon: 'success',
                        showCancelButton: false,                    
                        confirmButtonColor: '#3085d6',
                    })  

                    this.props.saveShipping( response.shipping );

                    this.close();

                }

            })

        } else {

            Swal.fire({
                title: 'Error!',
                text: `Shipping name required`,
                icon: 'error',
                showCancelButton: false,                    
                confirmButtonColor: '#3085d6',
            })  

        }

        

    }

    handleChange(e) {

        this.setState({ [e.target.name]: e.target.value });

    }

    open() {

        this.setState({ 
            open: true, 
            shipto: '',
            address1: '',
            address2: '',
            city: '',
            state: '',
            phone: '',
            zip: '',
            phone: '',
            attn: ''  
        });    

    }

    close() {

        this.setState({ open: false });

    }

    render() {

        return (

            <>
                <Button onClick={ this.open } color="primary">
                    <FontAwesomeIcon icon={faPlus} />
                </Button>
                <Modal isOpen={ this.state.open } toggle={ this.close } className="mw-100 w-50">
                    <ModalHeader>
                        Add Shipping Address
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Name</Label>
                            <Input type="text" name="shipto" value={ this.state.shipto } onChange={ this.handleChange } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Address</Label>
                            <Input className="mb-1" type="text" name="address1" value={ this.state.address1 } onChange={ this.handleChange }  />
                            <Input type="text" name="address2" value={ this.state.address2 }  onChange={ this.handleChange }  />
                        </FormGroup>

                        <FormGroup row>
                            <Col>
                                <Label>City</Label>
                                <Input type="text" name="city" value={ this.state.city }  onChange={ this.handleChange }  />
                            </Col>

                            <Col>

                                <Label>State</Label>
                                <Input type="text" name="state" value={ this.state.state }  onChange={ this.handleChange }  />
                            
                            </Col>

                            <Col>

                                <Label>Zip</Label>
                                <Input type="text" name="zip" value={ this.state.zip }  onChange={ this.handleChange }  />
                            
                            </Col>
                            
                        </FormGroup>                        

                        <FormGroup>
                            <Label>Attn</Label>
                            <Input type="text" name="attn" value={ this.state.attn }  onChange={ this.handleChange }  />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone</Label>
                            <Input type="text" name="phone" value={ this.state.phone }  onChange={ this.handleChangePhone }  />
                        </FormGroup>

                    </ModalBody>
                    <ModalFooter>
                        <Button color="success" onClick={ this.save }>Save</Button>
                        <Button color="primary" onClick={ this.close }>Close</Button>
                    </ModalFooter>
                </Modal>
            </>

        )

    }

}

