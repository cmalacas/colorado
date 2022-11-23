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

import classnames from 'classnames';

export default class Customers extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            customers : [],
            contacts: [],
            shiptos: [],
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

                this.setState( { 
                    customers: response.customers, 
                    contacts: response.contacts,
                    shiptos: response.shiptos
                } );

            }

        })

    }

    update( data ) {

        Authservice.updateCustomer( data )
        .then( response => {

            if (response.customers) {

                this.setState( { 
                    customers: response.customers, 
                    contacts: response.contacts,
                    shiptos: response.shiptos
                } );

            }

        })

    }

    getData() {

        Authservice.getCustomers()
        .then(response => {

            if (response.customers) {

                this.setState({
                    customers: response.customers, 
                    contacts: response.contacts,
                    shiptos: response.shiptos
                });

                ReactTooltip.rebuild();

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
        })

        const data = customers.map( (c,i) => {
            c.index = i + 1;
            const contacts = this.state.contacts.filter( cc => cc.customer_id === c.id )
            const shiptos = this.state.shiptos.filter( s => s.customer_id === c.id);

            c.actions = <Fragment>
                            <Edit  
                                customer={ c } 
                                save={ this.update } 
                                contacts={ contacts } 
                                shiptos={ shiptos } 
                            />
                            {/* <Contacts customer={ c } contacts={ contacts } save={ this.saveContact } update={ this.updateContact } delete={ this.deleteContact } /> */}
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

export class Add extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            name: '',
            open: false,
            errorName: false,
            contacts: [],
            shiptos: [],
            counter: 0,
            activeTab: 'contacts'
        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.save = this.save.bind(this);
        this.add = this.add.bind(this);
        this.updateContact = this.updateContact.bind(this);
        this.removeContact = this.removeContact.bind(this);
        this.toggle = this.toggle.bind(this);
        this.addShipTo = this.addShipTo.bind(this);
        this.updateShipTo = this.updateShipTo.bind(this);
        this.removeShipTo = this.removeShipTo.bind(this);
    }

    toggle( activeTab ) {
        this.setState( { activeTab } );
    }

    removeShipTo( id ) {
        const shiptos = this.state.shiptos.filter( c => c.counter != id );
        this.setState( { shiptos } );
    }

    removeContact( id ) {
        const contacts = this.state.contacts.filter( c => c.counter != id );
        this.setState( { contacts } );
    }

    updateShipTo( oldValue, newValue, row, column ) {

        const shiptos = this.state.shiptos.map( c => {

            if ( c.counter === row.counter ) {

                const field = column.dataField;

                if ( field === 'shipto' ) {

                    c.shipto = newValue;

                } else if ( field === 'address1' ) {

                    c.address1 = newValue;

                } else if ( field === 'city' ) {

                    c.city = newValue;

                } else if ( field === 'zip' ) {

                    c.zip = newValue;

                } else if ( field === 'state' ) {

                    c.state = newValue;

                } else if ( field === 'attn' ) {

                    c.attn = newValue;

                } else if ( field === 'phone' ) {

                    c.phone = newValue;

                }

            }


            return c;

        });

        this.setState( { shiptos } );

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

    addShipTo() {

        const counter = this.state.counter + 1;

        //const actions = <Button data-tip="Delete" onClick={ () => this.removeShipTo( counter ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>

        const shipto = { shipto: '', address1: '', address2: '', city: '', state: '', zip: '', attn: '', phone: '', counter };

        const shiptos = this.state.shiptos;

        shiptos.push( shipto );

        this.setState( { shiptos, counter } );

    }

    add() {

        const counter = this.state.counter + 1;

        //const actions = <Button data-tip="Delete" onClick={ () => this.removeContact( counter ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>

        const contact = { name: '', email: '', phone: '', phone_ext: '', mobile: '', fax: '',  counter };

        const contacts = this.state.contacts;

        contacts.push( contact );

        this.setState( { contacts, counter } );

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

            this.setState( { open: false, name: '', contacts: [], shiptos: [] } );

        } else {

            this.setState( { errorName } );

        }


    }    

    render() {

        const contacts = this.state.contacts.map( c => {

            //c.actions = <Button data-tip="Delete" onClick={ () => this.removeContact( counter ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>

            return c;

        })

        const shiptos = this.state.shiptos.map( c => {

            //c.actions = <Button data-tip="Delete" onClick={ () => this.removeShipTo( counter ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>

            return c;

        })

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
                    formatter: (cell, row) => {
                        return <Button onClick={() => this.removeContact(row.counter)} color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                    },
                    editable: false
                }
            ];

        const shipto_columns = [
                {
                    dataField: 'shipto',
                    text: 'Ship To'
                },
                {
                    dataField: 'address1',
                    text: 'Address 1',
                },
                {
                    dataField: 'address2',
                    text: 'Address 2',                    
                },
                {
                    dataField: 'city',
                    text: 'City',
                },
                {
                    dataField: 'state',
                    text: 'State',                    
                },
                {
                    dataField: 'zip',
                    text: 'Zip',
                },
                {
                    dataField: 'attn',
                    text: 'Attn',
                },
                {
                    dataField: 'phone',
                    text: 'Phone',
                    editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
                },
                {
                    dataField: 'actions',
                    text: '',
                    formatter: (cell, row) => {
                        return <Button onClick={() => this.removeShipTo(row.counter)} color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                    },
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
                        <Nav tabs>
                            <NavItem className="mr-1">
                                <NavLink className={ classnames( { active: this.state.activeTab === 'contacts'} )} onClick={() => this.toggle('contacts')}>
                                    Contacts
                                </NavLink>                                
                            </NavItem>
                            <NavItem>
                                <NavLink className={ classnames( { active: this.state.activeTab === 'shipto'} )} onClick={() => this.toggle('shipto')}>
                                    ShipTo
                                </NavLink>
                            </NavItem>
                        </Nav>
                        <TabContent className="p-3" activeTab={this.state.activeTab}>
                            <TabPane tabId="contacts">
                                <BootstrapTable 
                                    keyField='counter' 
                                    columns={ columns } 
                                    cellEdit={ cellEditFactory({ mode: 'click', blurToSave: true, afterSaveCell : this.updateContact }) }
                                    data={ contacts } striped hover 
                                />
                                <div className="text-right">
                                    <Button onClick={ this.add } color="primary">
                                        <FontAwesomeIcon icon={faPlus} />
                                    </Button>
                                </div>
                            </TabPane>
                            <TabPane tabId="shipto">
                                <BootstrapTable 
                                    keyField='counter' 
                                    columns={ shipto_columns } 
                                    cellEdit={ cellEditFactory({ mode: 'click', blurToSave: true, afterSaveCell : this.updateShipTo }) }
                                    data={ shiptos } striped hover 
                                />
                                <div className="text-right">
                                    <Button onClick={ this.addShipTo } color="primary">
                                        <FontAwesomeIcon icon={faPlus} />
                                    </Button>
                                </div>
                            </TabPane>
                        </TabContent>
                        <div className="d-flex justify-content-end">
                            <span className="small text-danger">please click Save after you update the information</span>
                        </div>
                        
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

export class Edit extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            id: 0,
            name: '',
            open: false,
            errorName: false,
            contacts: [],
            shiptos: [],
            counter: 0,
            activeTab: 'contacts'
        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);
        this.save = this.save.bind(this);
        this.updateContact = this.updateContact.bind(this);
        this.add = this.add.bind(this);
        this.delete = this.delete.bind(this);
        this.toggle = this.toggle.bind(this);
        this.addShipTo = this.addShipTo.bind(this);
        this.deleteShipTo = this.deleteShipTo.bind(this);
        this.updateShipTo = this.updateShipTo.bind(this);
    }

    updateShipTo( oldValue, newValue, row, column ) {

        const shiptos = this.state.shiptos.map( c => {

            if ( c.counter === row.counter ) {

                const field = column.dataField;

                if ( field === 'shipto' ) {

                    c.shipto = newValue;

                } else if ( field === 'address1' ) {

                    c.address1 = newValue;

                } else if ( field === 'city' ) {

                    c.city = newValue;

                } else if ( field === 'zip' ) {

                    c.zip = newValue;

                } else if ( field === 'state' ) {

                    c.state = newValue;

                } else if ( field === 'attn' ) {

                    c.attn = newValue;

                } else if ( field === 'phone' ) {

                    c.phone = newValue;

                }

            }


            return c;

        });

        this.setState( { shiptos } );

    }

    addShipTo() {

        const counter = this.state.counter + 1;

        //const actions = <Button data-tip="Delete" onClick={ () => this.deleteShipTo( counter ) } color="danger"><FontAwesomeIcon icon={faTrash} /></Button>

        const shipto = { shipto: '', address1: '', address2: '', city: '', state: '', zip: '', attn: '', phone: '', counter };

        const shiptos = this.state.shiptos;

        shiptos.push( shipto );

        this.setState( { shiptos, counter } );

    }

    toggle( activeTab ) {
        this.setState( { activeTab } );
    }

    deleteShipTo( counter ) {
        const shiptos = this.state.shiptos.filter( c => c.counter != counter );
        this.setState( { shiptos } );
    }

    delete( counter ) {

        const contacts = this.state.contacts.filter( c => c.counter != counter );
        this.setState( { contacts } );
    }

    add() {

        const contacts = this.state.contacts;

        const counter = this.state.counter + 1;

        //const actions = <Button color="danger" onClick={ () => this.delete( counter ) }><FontAwesomeIcon icon={faTrash} /></Button>

        const contact = { id: 0, name: '', email: '', phone: '', phone_ext: '', fax: '', counter, mobile: '' }

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

        const {id, name, contacts, shiptos} = this.state;

        if ( name === '') {

            valid = false;
            errorName = true;

        }

        if (valid) {

            console.log('valid', this.state);
            console.log('contacts', contacts, shiptos);

            const data = {id, name, contacts, shiptos}

            this.props.save( data );

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
                
                return c;

            });

            const shiptos = this.props.shiptos.map( c => {

                c.counter = ++counter;
                
                return c;

            });

            console.log('update', this.state, this.props, shiptos, contacts);

            this.setState( { 
                id: this.props.customer.id, 
                name: this.props.customer.name, 
                contacts,
                shiptos,
                counter
            } );

        }

    }

    render() {

        const contacts = this.state.contacts.map( c => {

            //c.actions = <Button color="danger" onClick={ () => this.delete( c.counter ) }><FontAwesomeIcon icon={faTrash} /></Button>

            return c;


        })

        const shiptos = this.state.shiptos.map( c => {

            //c.actions = <Button color="danger" onClick={ () => this.deleteShipTo( c.counter ) }><FontAwesomeIcon icon={faTrash} /></Button>

            return c;

        })

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
                formatter: (cell, row) => {
                    return <Button onClick={() => this.delete(row.counter)} color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                },
                editable: false
            }
        ];

        const shipto_columns = [
            {
                dataField: 'shipto',
                text: 'Ship To'
            },
            {
                dataField: 'address1',
                text: 'Address 1',
            },
            {
                dataField: 'address2',
                text: 'Address 2',                    
            },
            {
                dataField: 'city',
                text: 'City',
            },
            {
                dataField: 'state',
                text: 'State',                    
            },
            {
                dataField: 'zip',
                text: 'Zip',
            },
            {
                dataField: 'attn',
                text: 'Attn',
            },
            {
                dataField: 'phone',
                text: 'Phone',
                editorRenderer:  (editorProps, value, row, column, rowIndex, columnIndex ) => <PhoneFormatting { ...editorProps } value={ value } />
            },
            {
                dataField: 'actions',
                text: '',
                formatter: (cell, row) => {
                    return <Button onClick={() => this.deleteShipTo(row.counter)} color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                },
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
                        <FormGroup row>
                            <Col md={6}>
                                <Label>
                                    Customer
                                </Label>
                                <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                                { this.state.errorName ? <div className="alert alert-danger">this is required</div> : '' }
                            </Col>
                        </FormGroup>

                        <Nav tabs>
                            <NavItem className="mr-1">
                                <NavLink className={classnames({active: this.state.activeTab === 'contacts'})} onClick={() => this.toggle('contacts')}>
                                    Contacts
                                </NavLink>
                            </NavItem>
                            <NavItem>
                                <NavLink className={classnames({active: this.state.activeTab === 'shipto'})} onClick={() => this.toggle('shipto')}>
                                    ShipTo
                                </NavLink>
                            </NavItem>
                        </Nav>
                        <TabContent className="p-2" activeTab={ this.state.activeTab }>
                            <TabPane tabId="contacts">
                                <BootstrapTable 
                                    keyField='counter' 
                                    columns={ columns } 
                                    cellEdit={ cellEditFactory(
                                            { 
                                                mode: 'click', 
                                                blurToSave: true, 
                                                afterSaveCell : this.updateContact 
                                            }) }
                                    data={ contacts } striped hover 
                                />
                                <div className="text-right">
                                    <Button onClick={ this.add } color="primary">
                                        <FontAwesomeIcon icon={faPlus} />
                                    </Button>
                                </div>
                            </TabPane>
                            <TabPane tabId="shipto">
                                <BootstrapTable 
                                    keyField='counter' 
                                    columns={ shipto_columns } 
                                    cellEdit={ cellEditFactory(
                                            { 
                                                mode: 'click', 
                                                blurToSave: true, 
                                                afterSaveCell : this.updateShipTo
                                            }) }
                                    data={ shiptos } striped hover 
                                />
                                <div className="text-right">
                                    <Button onClick={ this.addShipTo } color="primary">
                                        <FontAwesomeIcon icon={faPlus} />
                                    </Button>
                                </div>
                            </TabPane>
                        </TabContent>

                        <div className="d-flex justify-content-end">
                            <span className="small text-danger">please click Save after you update the information</span>
                        </div>

                        
                        

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