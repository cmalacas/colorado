import React, { Component, Fragment } from 'react';
import { Card, CardBody, Input, FormGroup, Row, Col, Label, CardFooter, Button, CardHeader, ModalHeader, ModalBody, ModalFooter, Modal } from 'reactstrap';
import Authservice from '../components/Authservice';

import { phone_number_check } from '../components/Functions';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faUser, faUserCheck, faTimes, faEdit, faPlus } from '@fortawesome/free-solid-svg-icons';
import Swal from 'sweetalert2';

import { Add } from './Vendors'

import Select from 'react-select';

export default class PurchaseOrders extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            customers: [],
            orders: [],
            contacts: [],
            todaysdate: '',
            to: '',
            phone: '',
            extension: '',
            cellphone: '',
            email: '',
            ship: 'Pickup',
            datereqd: '',
            fax: '',
            for: '',
            contact: '',
            address: '',
            shippingco: '',
            lastItem: 0,
            productionOrders: [],
        }

        this.change = this.change.bind( this );
        this.changePhone = this.changePhone.bind(this);
        this.addItem = this.addItem.bind( this );
        this.save = this.save.bind( this );
        this.selected = this.selected.bind( this );
        this.updateContact = this.updateContact.bind(this);
        this.updateItems = this.updateItems.bind(this);
        this.removeItem = this.removeItem.bind(this);
        this.addContact = this.addContact.bind(this);
        this.vendorSelected = this.vendorSelected.bind(this);
        this.saveVendor = this.saveVendor.bind(this);
        this.selectContact = this.selectContact.bind(this);
    }

    selectContact( c ) {

        this.setState( { contact: c.value } );


    }

    saveVendor( data ) {

        Authservice.saveVendor( data )
        .then( response => {

            if (response.vendors) {

                this.setState( { customers: response.vendors } );

            }

        })

    }

    vendorSelected( e ) {

        const to = parseInt( e.value );

        const vendor = this.state.customers.filter( c => c.id === to );

        const address = vendor.length > 0 ? vendor[0].address : '';

        this.setState( { to, address } );        

    }

    addContact( data ) {

        data.vendor_id = this.state.to;

        Authservice.saveVendorContacts( data )
        .then( response => {

            if ( response.contacts ) {

                this.setState( { contacts: response.contacts } );

            }

        })


    }

    removeItem( data )  {

        const productionOrders = this.state.productionOrders.filter( p => p.itemNo !== data.itemNo );

        this.setState( { productionOrders } );

    }

    updateItems( data ) {

        const productionOrders = this.state.productionOrders.map( p => {

            if (p.itemNo === data.itemNo) {

                p.production_order_id = data.production_order_id;
                p.qty = data.qty;
                p.price = data.price;
                p.date = data.date;
                p.recvd = data.recvd;
                p.description = data.description;

            }

            return p;

        });

        this.setState( { productionOrders } );

    }

    changePhone( e ) {

        const value = phone_number_check( e );
        this.setState( { [e.target.name] : value } )

    }

    updateContact( data ) {

        Authservice.updateVendorContacts( data )
        .then( response => {

            if ( response.contacts ) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    selected( name, phone, extension, fax, email, cellphone ) {

        this.setState( { contact: name, phone, extension, email, fax, cellphone } );

    }

    save() {

        const { todaysdate, to, phone, cellphone, email, ship, datereqd, fax, shippingco, productionOrders, comments, address, contact, extension } = this.state;

        const _for = this.state.for;

        const data = { todaysdate, to, phone, cellphone, email, ship, datereqd, fax, _for, shippingco, productionOrders, comments, address, contact, extension  }

        Authservice.savePurchaseOrders( data )
        .then( response => {

            if (response.success) {

                location = `/purchase-orders/${response.purchase.id}/edit`

            }

        })

    }

    componentDidMount() {

        Authservice.getPurchaseOrdersData()
        .then( response => {

            if ( response.customers ) {

                this.setState( { customers: response.customers, 
                                 orders: response.production_orders, 
                                 contacts: response.contacts } );

            }

        })

    }

    addItem() {

        const productionOrders = this.state.productionOrders;

        const lastItem = this.state.lastItem + 1;

        const order = { itemNo: lastItem, id: 0, qty: 0, price: 0, recvd: 0, date: '', description: '', action: '', production_order_id: 0 }

        productionOrders.push( order );

        this.setState( { productionOrders, lastItem } );

    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value } );

    }

    render() {

        const to = parseInt(this.state.to);

        const contacts = this.state.contacts.filter( c => c.vendor_id === to )

        const options =  this.state.customers.map( c => {

            return { value: c.id, label: c.vendor };

        });

        const contactOptions = contacts.map( c => {

            return { value: c.id, label: c.name }

        });

        const customer = this.state.customers.filter( c => c.id === this.state.to );

        const vendor = customer.length > 0 ? { value: customer[0].id, label: customer[0].vendor } : '' ;

        const contact = contacts.filter( c => c.id === this.state.contact );

        const contactSelected = contact.length > 0 ? { value: contact[0].id, label: contact[0].name } : '';

        return (

            <Fragment>

                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Purchase Orders - Create</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Purchase Orders - Create</li>
                            </ol>                        
                        </div>
                    </div>
                </div>

                <Card>
                    <CardHeader className="d-flex justify-content-end">
                        <Button onClick={ this.save } color="primary">Save</Button>
                    </CardHeader>
                    <CardBody>

                        <FormGroup row>
                            <Col md={4}>
                                <Label>Purchase Order #</Label>
                                <Input type="text" disabled={ true } />
                            </Col>
                            <Col md={4}>
                                <Label>Today's Date</Label>
                                <Input type="date" name="todaysdate" value={ this.state.todaysdate } onChange={ this.change } />
                            </Col>
                            <Col md={4}>
                                <Label>Date Required</Label>
                                <Input type="date" name="datereqd" value={ this.state.datereqd } onChange={ this.change } />
                            </Col>
                        </FormGroup>

                        <FormGroup row>
                            <Col md={6}>
                            <Row>
                                    <Col>
                                        <Label className="d-block">To</Label>
                                        <div className="d-flex justify-content-between">
                                            {/* <Input type="select" name="to" value={ this.state.to } onChange={ this.vendorSelected }>
                                                <option value="0">select customer</option>
                                                {
                                                    this.state.customers.map( c => {

                                                        return <option value={c.id}>{c.vendor}</option>

                                                    })
                                                }
                                            </Input> */}
                                            <Select
                                                className="w-100"
                                                name="to"
                                                defaultValue={ vendor }
                                                value={ vendor }
                                                options={ options }
                                                onChange={ this.vendorSelected }
                                            />
                                            <div className="ml-1">
                                                <Add icon={ faPlus } save={ this.saveVendor } />
                                            </div>
                                        </div>
                                    </Col>
                                </Row>
                                <Row className="mt-3">
                                    <Col>
                                        <Label>Address</Label>
                                        <Input type="textarea" name="address" rows={5} value={ this.state.address } onChange={ this.change } />
                                    </Col>
                                </Row>
                            </Col>
                            <Col md={6}>
                                
                                <Row>
                                    <Col>
                                        <Label>Contact</Label>
                                        <div className="d-flex">
                                            <Select 
                                                className="w-100"
                                                name="contact" 
                                                value={ contactSelected } 
                                                defaultValue={ contactSelected } 
                                                onChange={ this.selectContact } 
                                                options={ contactOptions } 
                                            />
                                            <Contact contacts={ contacts } to={ to } select={ this.selected } update={ this.updateContact } save={ this.addContact } />
                                        </div>
                                    </Col>
                                </Row>
                                <Row className="mt-3">
                                    <Col>
                                        <Label>For</Label>                                
                                        <Input type="text" name="for" value={ this.state.for } onChange={ this.change } />
                                    </Col>
                                </Row>
                                <Row className="mt-3">
                                    <Col>
                                        <Label>Email</Label>
                                        <Input type="text" name="email" value={ this.state.email } onChange={ this.change } />
                                    </Col>
                                </Row>
                            </Col>
                            
                        </FormGroup>
                       

                        <FormGroup row>
                            <Col md={3}>
                                <Label>Phone</Label>
                                <Input type="text" name="phone" value={ this.state.phone } onChange={ this.changePhone } />
                            </Col>
                            <Col md={1}>
                                <Label>Extension</Label>
                                <Input type="text" name="extension" value={ this.state.extension } onChange={ this.change } />
                            </Col>
                            <Col md={4}>
                                <Label>Fax</Label>
                                <Input type="text" name="fax" value={ this.state.fax } onChange={ this.changePhone } />
                            </Col>
                            <Col md={4}>
                                <Label>Cellphone</Label>
                                <Input type="text" name="cellphone" value={ this.state.cellphone } onChange={ this.changePhone } />
                            </Col>

                        </FormGroup>

                        

                        <FormGroup row className="pb-4">
                            <Col md={6}>
                                <Label>Shipping Company</Label>
                                <Input type="text" name="shippingco" value={ this.state.shippingco } onChange={ this.change } />
                            </Col>
                            <Col md={6}>
                                <Label>Ship</Label>
                                <Input type="select" name="ship" onChange={ this.change }>
                                    <option value="">Select</option>
                                    <option value="Pickup">Pickup</option>
                                    <option value="Ship Via">Ship Via</option>
                                </Input>
                            </Col>
                        </FormGroup>

                        <table className="table table-border table-striped table-hover mt-4">

                            <thead>
                                <tr>
                                    <th>
                                        Production Order#
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Received
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                {
                                    this.state.productionOrders.map( p => {

                                        return <ProductionOrder 
                                                    order={ p } 
                                                    contacts={ this.state.contacts } 
                                                    orders={ this.state.orders } 
                                                    change={ this.updateItems } 
                                                    remove={ this.removeItem } />

                                    })
                                }

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td className="text-right" colSpan={7}>

                                        <Button onClick={ this.addItem } color="success">Add Item</Button>

                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                        <FormGroup>
                            <Label>Comments</Label>
                            <Input type="textarea" name="comments" onChange={ this.change } />
                        </FormGroup>

                    </CardBody>
                    <CardFooter className="d-flex justify-content-end">
                        <Button onClick={ this.save } color="primary">Save</Button>
                    </CardFooter>
                </Card>

            </Fragment>

        )

    }

}

export class Contact extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.select = this.select.bind( this );

    }

    select( contact ) {

        const phone = contact.phone;
        const phone_ext = contact.phone_ext;
        const name = contact.name;
        const email = contact.email;
        const mobile = contact.mobile;
        const fax = contact.fax;

        this.setState( { open: false }, () => {

            this.props.select( name, phone, phone_ext, fax, email, mobile )

        } );

    }

    open() {

        if ( this.props.to > 0 )

            this.setState( { open: true } );

        else 

            Swal.fire( {

                title: 'Select Customer',
                icon: 'error',
                html: 'Please select a customer first!'

            })

    }

    close() {

        this.setState( { open: false } )

    }

    render() {

        const contacts = this.props.contacts;

        return (

            <Fragment>
                <Button onClick={ this.open } className="ml-1" color="primary"><FontAwesomeIcon icon={faUser} /></Button>
                <Modal isOpen={this.state.open} toggle={this.close} className="mw-100 w-75">
                    <ModalHeader>
                        Contacts
                    </ModalHeader>
                    <ModalBody>
                        
                        <Row>

                            <Col className="text-right"><AddNewContact save={ this.props.save } /></Col>
                        
                        </Row>

                        <table className="table table-hover table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone / Ext</th>
                                <th>Fax</th>
                                <th>Cellphone</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                {
                                    contacts.map( c => {

                                        return <tr>

                                                <td>{c.name}</td>
                                                <td>{c.email}</td>
                                                <td>{c.phone} {c.phone_ext ? `/ {${c.phone_ext}}` : '' }</td>
                                                <td>{c.fax}</td>
                                                <td>{c.mobile}</td>
                                                <td>
                                                    <Button onClick={ () => this.select( c ) } className="mr-1" color="primary"><FontAwesomeIcon icon={faUserCheck} /></Button>
                                                    <Edit contact={ c } save={ this.props.update } />
                                                </td>

                                            </tr>

                                    })
                                }
                            </tbody>
                        </table>
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={ this.close } color="light">Close</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }

}

class AddNewContact extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,

            vendor_id: 0,

            name: '',
            phone: '',
            phone_ext: '',
            fax: '',
            email: '',
            mobile: '',

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
        this.changePhone = this.changePhone.bind(this);
    }

    changePhone( e ) {

        const value = phone_number_check( e );

        this.setState( { [e.target.name] : value  } );

    }

    change( e ) {

        this.setState( { [e.target.name] : e.target.value } );

    }

    save() {

        this.setState( { open: false }, () => {

            this.props.save( this.state );

        })

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } )

    }

    render() {

        return (

            <Fragment>
                <Button className="mb-2" onClick={ this.open } color="primary">Add New Contact</Button>
                <Modal isOpen={this.state.open} toggle={ this.close } className="mw-100 w-50">
                    <ModalHeader>
                        Add New Contact
                    </ModalHeader>
                    <ModalBody>
                        
                        <FormGroup>
                            <Label>Name</Label>
                            <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Email</Label>
                            <Input type="text" name="email" value={ this.state.email } onChange={ this.change } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone</Label>
                            <Input type="text" name="phone" value={ this.state.phone } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone Ext</Label>
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

                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={ this.save } color="primary">Save</Button>
                        <Button onClick={ this.close } color="danger">Cancel</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }

}

class Edit extends Component {

    constructor( props ) {

        super( props )

        this.state = {

            open: false,

            vendor_id: props.contact.vendor_id,
            id: props.contact.id,
            name: props.contact.name,
            phone: props.contact.phone,
            phone_ext: props.contact.phone_ext,
            email: props.contact.email,
            fax: props.contact.fax,
            mobile: props.contact.mobile

        }

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
        this.changePhone = this.changePhone.bind(this);

    }

    changePhone( e ) {

        const value = phone_number_check( e );

        this.setState( { [e.target.name] : value  } );

    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value } );

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false });

    }

    save() {

        this.setState( { open: false }, () => {

            this.props.save( this.state );

        });
    }

    render() {

        return (

            <Fragment>

                <Button onClick={this.open} color="info"><FontAwesomeIcon icon={faEdit} /></Button>
                <Modal isOpen={this.state.open} toggle={this.close} className="mw-100 w-50">
                    <ModalHeader>Edit Contact</ModalHeader>
                    <ModalBody>

                        <FormGroup>
                            <Label>Name</Label>
                            <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Email</Label>
                            <Input type="text" name="email" value={ this.state.email } onChange={ this.change } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone</Label>
                            <Input type="text" name="phone" value={ this.state.phone } onChange={ this.changePhone } />
                        </FormGroup>

                        <FormGroup>
                            <Label>Phone Ext</Label>
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

                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={ this.save } className="mr-1" color="success">Save</Button>
                        <Button onClick={ this.close } color="danger">Close</Button>
                    </ModalFooter>
                </Modal>

            </Fragment>

        )

    }


}

export class ProductionOrder extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            itemNo: 0,
            qty: '',
            price: '',
            recvd: '',
            production_order_id: 0,
            date: '',
            description: '',
            height: 'auto',
        }

        this.DescriptionRef = React.createRef();

        this.change = this.change.bind(this);
        this.remove = this.remove.bind(this);
        this.updateDescription = this.updateDescription.bind(this);
    }

    updateDescription( e ) {

        const height = e.target.scrollHeight;        

        this.setState( { description: e.target.value, height: `${height}px` }, () => this.props.change( this.state ) );

    }

    remove() {

        this.props.remove( this.state );

    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value }, () => this.props.change( this.state ) );

    }

    componentDidUpdate() {

        if ( this.state.itemNo !== this.props.order.itemNo ) {

            const order = this.props.order;

            this.setState(
                {
                    itemNo: order.itemNo,
                    production_order_id: order.production_order_id,
                    price: order.price,
                    qty: order.qty,
                    recvd: order.recvd,
                    date: order.date,
                    description: order.description

                }
            );

        }

    }

    componentDidMount() {

        if ( this.state.itemNo !== this.props.order.itemNo ) {

            const order = this.props.order;

            this.setState(
                {
                    itemNo: order.itemNo,
                    production_order_id: order.production_order_id,
                    price: order.price,
                    qty: order.qty,
                    recvd: order.recvd,
                    date: order.date,
                    description: order.description

                }
            );

        }

    }

    render() {

        const orders = this.props.orders;

        return (

            <Fragment>

                <tr>
                    <td>
                        <Input type="textt" name="production_order_id" value={ this.state.production_order_id } onChange={ this.change } />
                    </td>
                    <td>
                        <Input type="text" value={ this.state.qty } name="qty"  onChange={ this.change }/>
                    </td>
                    <td>
                        <Input style={ { height: this.state.height, overflowY:'hidden' } } type="textarea" name="description" value={ this.state.description } onChange={ this.updateDescription } ref={ this.DescriptionRef } />
                    </td>
                    <td>
                        <Input type="text" value={ this.state.price } name="price" onChange={ this.change } />
                    </td>
                    <td>
                        <Input type="select" value={ this.state.recvd } name="recvd" onChange={ this.change }>
                            <option value="">Select</option>
                            <option value="Complete">Complete</option>
                            <option value="Partial">Partial</option>
                        </Input>
                    </td>
                    <td>
                        <Input type="date" value={ this.state.date } name="date" onChange={ this.change } />
                    </td>                    
                    <td>
                        <Button onClick={ this.remove } color="danger"><FontAwesomeIcon icon={faTimes} /></Button>
                    </td>
                </tr>
                

            </Fragment>

        )

    }

}