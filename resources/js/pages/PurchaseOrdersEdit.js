import { faShekelSign } from '@fortawesome/free-solid-svg-icons';
import React, { Component, Fragment } from 'react';
import { Card, CardBody, Input, FormGroup, Row, Col, Label, CardFooter, Button, CardHeader } from 'reactstrap';
import Authservice from '../components/Authservice';

import { Contact, ProductionOrder } from './PurchaseOrders';

import { phone_number_check } from '../components/Functions';
import Swal from 'sweetalert2';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCopy, faPrint, faArrowLeft, faPlus, faChevronLeft, faChevronRight } from '@fortawesome/free-solid-svg-icons';

import { Add } from './Vendors';

export default class PurchaseOrdersEdit extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            id: 0,
            customers: [],
            orders: [],
            contacts: [],
            todaysdate: '',
            to: '',
            phone: '',
            extension:'',
            cellphone: '',
            email: '',
            ship: '',
            datereqd: '',
            fax: '',
            for: '',
            contact: '',
            address: '',
            shippingco: '',
            lastItem: 0,
            next: 0,
            previous: 0,
            pos: [],
            productionOrders: [],
        }

        this.change = this.change.bind( this );
        this.addItem = this.addItem.bind( this );
        this.save = this.save.bind( this );
        this.changePhone = this.changePhone.bind(this);
        this.updateContact = this.updateContact.bind(this);
        this.selected = this.selected.bind(this);
        this.updateItems = this.updateItems.bind(this);
        this.removeItem = this.removeItem.bind(this);
        this.print = this.print.bind(this);
        this.copy = this.copy.bind(this);
        this.back = this.back.bind(this);
        this.addContact = this.addContact.bind(this);
        this.vendorSelected = this.vendorSelected.bind(this);
        this.add = this.add.bind(this);
        this.select = this.select.bind(this);
        this.next = this.next.bind(this);
        this.previous = this.previous.bind(this);
        this.saveVendor = this.saveVendor.bind(this);
    }

    saveVendor( data ) {

        Authservice.saveVendor( data )
        .then( response => {

            if (response.vendors) {

                this.setState( { customers: response.vendors } );

            }

        })

    }

    next() {

        location = `/purchase-orders/${this.state.next}/edit`;

    }

    previous() {

        location = `/purchase-orders/${this.state.previous}/edit`;

    }

    select( e ) {

        location = `/purchase-orders/${e.target.value}/edit`;

    }

    add() {
        location = '/purchase-orders/create';
    }

    vendorSelected( e ) {

        const to = parseInt( e.target.value );

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

    print() {

        window.open(`/purchase-orders/${this.state.id}/print`, 'purchaseOrders', 'width=999 height=999')

    }

    copy() {

        Authservice.copyPurchaseOrder( { id: this.state.id })
        .then( response => {

            if ( response.id ) {

                location = `/purchase-orders/${response.id}/edit`;

            }

        })

    }

    back() {

        location = '/purchase-orders';

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

        const { id, todaysdate, to, phone, cellphone, email, ship, datereqd, fax, shippingco, productionOrders, comments, contact, address, extension } = this.state;

        const _for = this.state.for;

        const data = { id, todaysdate, to, phone, cellphone, email, ship, datereqd, fax, _for, shippingco, productionOrders, comments, address, contact, extension }

        Authservice.updatePurchaseOrders( data )
        .then( response => {

            if (response.success) {

                Swal.fire( {

                    title: 'Success!',
                    icon: 'success',
                    html: 'Purchase Order saved'

                })

            }

        })   

    }

    componentDidMount() {

        const id = this.props.match.params.id;;

        Authservice.getPurchaseOrdersData( { id } )
        .then( response => {

            if ( response.customers ) {

                const purchase = response.purchase;

                //const id = purchase.id;
                const ship = purchase.ship;
                const shippingco = purchase.shippingco;
                const todaysdate = purchase.todaysdate;
                const email = purchase.email;
                const fax = purchase.fax;
                const _for = purchase.for;
                const to = purchase.to;
                const phone = purchase.phone;
                const extension = purchase.extension;
                const datereqd = purchase.datereqd;
                const comments = purchase.comments;
                const cellphone = purchase.cellphone;
                const contact = purchase.contact;
                const address = purchase.address;

                const next = response.next;
                const previous = response.previous;

                const pos = response.pos;

                const productionOrders = purchase.items.map( (i,index) => {

                    i.itemNo = index + 1;

                    return i;

                });

                

                const orders = response.production_orders;

                this.setState( { customers: response.customers, 
                                 productionOrders, 
                                 orders,
                                 contacts: response.contacts,
                                 id,
                                 ship,
                                 shippingco,
                                 fax,
                                 to,
                                 address,
                                 contact,
                                 for: _for,
                                 todaysdate,
                                 email,
                                 phone,
                                 extension,
                                 datereqd,
                                 comments,
                                 cellphone,
                                 previous,
                                 next,
                                 pos
                                } );

            }

        })

    }

    addItem() {

        const productionOrders = this.state.productionOrders;

        const lastItem = this.state.lastItem + 1;

        const order = { itemNo: lastItem, id: 0, qty: 0, price: 0, recvd: '', date: '', description: '', action: '', production_order_id: 0 }

        productionOrders.push( order );

        this.setState( { productionOrders, lastItem } );

    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value } );

    }

    render() {

        const to = parseInt(this.state.to);

        const contacts = this.state.contacts.filter( c => c.vendor_id === to )

        return (

            <Fragment>

                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Purchase Orders - Edit</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item"><a href="/purchase-orders">Purchase Orders</a></li>
                                <li className="breadcrumb-item active">{ this.state.id }</li>
                            </ol>                        
                        </div>
                    </div>
                </div>

                <Card>
                    <CardHeader className="d-flex justify-content-between">

                        <div className="d-flex justify-content-between">

                            { this.state.id > this.state.previous ?

                            <Button color="info" onClick={ this.previous } className="mr-1"><FontAwesomeIcon icon={faChevronLeft} /></Button>

                            : '' }

                            <Input onChange={ this.select } type="select" value={this.state.id}>
                                {
                                    this.state.pos.map( p => {

                                        return <option value={p.id}>{p.id}</option>

                                    })
                                }
                            </Input>

                            { this.state.id < this.state.next ?

                            <Button color="info" onClick={ this.next } className="ml-1"><FontAwesomeIcon icon={faChevronRight} /></Button>

                            : '' }

                        </div>

                        <div>
                            <Button className="mr-1" onClick={ this.save } color="primary">Save</Button>
                            <Button onClick={ this.print } className="mr-1" color="info"><FontAwesomeIcon icon={faPrint} /></Button>
                            <Button onClick={ this.copy } className="mr-1" color="info"><FontAwesomeIcon icon={faCopy} /></Button>
                            <Button onClick={ this.add } className="mr-1" color="info"><FontAwesomeIcon icon={faPlus} /></Button>
                            <Button onClick={ this.back } color="info"><FontAwesomeIcon icon={faArrowLeft} /></Button>
                        </div>
                    </CardHeader>
                    <CardBody>

                        <FormGroup row>
                            <Col md={4}>
                                <Label>Purchase Order #</Label>
                                <Input type="text" value={ this.state.id } disabled={ true } />
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
                                            <Input type="select" name="to" value={ this.state.to } onChange={ this.vendorSelected }>
                                                <option value="0">select customer</option>
                                                {
                                                    this.state.customers.map( c => {

                                                        return <option value={c.id}>{c.vendor}</option>

                                                    })
                                                }
                                            </Input>
                                            <div className="ml-1">
                                                <Add icon={ faPlus } save={ this.saveVendor } />
                                            </div>
                                        </div>
                                    </Col>
                                </Row>
                                <Row className="mt-3">
                                    <Col>
                                        <Label>Address</Label>                               
                                        <Input type="textarea" rows={5} name="address" value={ this.state.address } onChange={ this.change } />    
                                    </Col>
                                </Row>
                            </Col>

                            <Col md={6}>
                                <Row>
                                    <Col>
                                        <Label>Contact</Label>
                                        <div className="d-flex">
                                            <Input type="text" name="contact" value={ this.state.contact } onChange={ this.change } />
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
                                <Input type="select" name="ship" value={ this.state.ship } onChange={ this.change }>
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
                            <Input type="textarea" name="comments" value={ this.state.comments } onChange={ this.change } />
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