import React, { Component, Fragment } from 'react';
import { Card, CardBody, Input, FormGroup, Row, Col, Label, CardFooter, Button, CardHeader, Nav, NavItem, NavLink, TabPane, TabContent, Modal, ModalHeader, ModalBody, ModalFooter } from 'reactstrap';
import Authservice from '../components/Authservice';

import Dropzone from 'react-dropzone';

import { Contact, ProductionOrder } from './PurchaseOrders';

import { phone_number_check } from '../components/Functions';
import Swal from 'sweetalert2';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCopy, faPrint, faArrowLeft, faPlus, faChevronLeft, faChevronRight, faFilePdf, faTrash, faEnvelope, faBan, faPaperPlane } from '@fortawesome/free-solid-svg-icons';

import { Add } from './Vendors';

import Select from 'react-select';

import Axios from 'axios';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import ReactTooltip from 'react-tooltip';

export default class PurchaseOrdersEdit extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            id: 0,
            customers: [],
            orders: [],
            contacts: [],
            todaysdate: '',
            to: 0,
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
            shipTo: '',
            lastItem: 0,
            next: 0,
            previous: 0,
            pos: [],
            entered: 0,
            productionOrders: [],
            documents: [],

            activeTab: 'general',
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
        this.selectContact = this.selectContact.bind(this);
        this.deleteContact = this.deleteContact.bind(this);

        this.toggle = this.toggle.bind(this);
        this.upload = this.upload.bind(this);
        this.deleteDocument = this.deleteDocument.bind(this);

        

    }

    
    deleteDocument( data ) {

        const documents = this.state.documents.filter( d => d.id != data.id );

        this.setState( { documents } );

        Authservice.deletePurchaseOrderDocument( { id: data.id } );

    }

    upload( data ) {

        const id = this.state.id;

        Axios.post('/purchase-orders/' + id + '/upload', data )
        .then( response => {

            const data = response.data;
  
            if ( data.success ) {

                this.setState( { documents: data.documents } );

            }
  
        });

    }

    toggle( activeTab ) {

        this.setState( { activeTab } );

    }

    deleteContact( contact ) {

        const data = { id: contact.id }

        Authservice.deleteVendorContact( data )
        .then( response => {

            if ( response.contacts ) {

                this.setState( { contacts: response.contacts } );

            }

        })

    }

    selectContact( c ) {

        const contact = this.state.contacts.filter( cc => cc.id === parseInt(c.value) );

        const email = contact.length > 0 ? contact[0].email : '';
        const phone = contact.length > 0 ? contact[0].phone : '';
        const extension = contact.length > 0 ? contact[0].phone_ext : '';
        const fax = contact.length > 0 ? contact[0].fax : '';
        const cellphone = contact.length > 0 ? contact[0].mobile : '';

        this.setState( { email: '', phone: '', extension: '', fax: '', cellphone: ''}, () => {

            this.setState( { contact: c.value, email: email, phone: phone, extension: extension, fax: fax, cellphone: cellphone } );

        } )


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

        const to = parseInt( e.value );

        const vendor = this.state.customers.filter( c => c.id === to );

        const address = vendor.length > 0 ? vendor[0].address : '';

        this.setState( { to, address, contact: '', email: '', phone: '', extension: '', fax: '', cellphone: '' } );        

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

    selected( name, phone, extension, fax, email, cellphone, contact_id ) {

        this.setState( { for: name, contact: contact_id, phone, extension, email, fax, cellphone } );

    }

    save() {

        const { id, todaysdate, to, phone, cellphone, email, ship, datereqd, fax, shippingco, productionOrders, comments, contact, address, extension, shipTo, entered } = this.state;

        const _for = this.state.for;

        const data = { id, todaysdate, to, phone, cellphone, email, ship, datereqd, fax, _for, shippingco, productionOrders, comments, address, contact, extension, shipTo, entered }

        Authservice.updatePurchaseOrders( data )
        .then( response => {

            if (response.success) {

                Swal.fire( {

                    title: 'Success!',
                    icon: 'success',
                    timer: 500,
                    timerProgressBar: true,
                    html: 'Purchase Order saved',                    

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
                const shipTo = purchase.shipTo;
                const documents = purchase.documents;
                const entered = purchase.entered;

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
                                 shipTo,
                                 cellphone,
                                 previous,
                                 next,
                                 pos,
                                 documents,
                                 entered
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

                            <Button data-tip="Previous" color="info" onClick={ this.previous } className="mr-1"><FontAwesomeIcon icon={faChevronLeft} /></Button>

                            : '' }

                            <Input onChange={ this.select } type="select" value={this.state.id}>
                                {
                                    this.state.pos.map( p => {

                                        return <option value={p.id}>{p.id}</option>

                                    })
                                }
                            </Input>

                            { this.state.id < this.state.next ?

                            <Button data-tip="Next" color="info" onClick={ this.next } className="ml-1"><FontAwesomeIcon icon={faChevronRight} /></Button>

                            : '' }

                        </div>

                        <div>
                            <Button className="mr-1" onClick={ this.save } color="primary">Save</Button>
                            <Button data-tip="Print" onClick={ this.print } className="mr-1" color="info"><FontAwesomeIcon icon={faPrint} /></Button>
                            
                            <Email id={ this.state.id } />
                            
                            <Button data-tip="Add New Purchase Order" onClick={ this.add } className="mr-1" color="info"><FontAwesomeIcon icon={faPlus} /></Button>
                            <Button data-tip="Back" onClick={ this.back } color="info" className="mr-1"><FontAwesomeIcon icon={faArrowLeft} /></Button>
                            <Button data-tip="Copy" onClick={ this.copy } className="mr-1" color="info"><FontAwesomeIcon icon={faCopy} /></Button>
                        </div>
                    </CardHeader>
                    <CardBody>

                        <FormGroup className="mb-1 form-inline">
                            <Label><Input className="position-relative ml-0" onChange={ () => this.setState( { entered: this.state.entered === 0 ? 1 : 0 } ) } type="checkbox" checked={ this.state.entered === 1 } /> Entered</Label>
                        </FormGroup>

                        <Nav className="mb-4 position-relative" tabs>
                            <NavItem>
                                <NavLink className={`mt-2 ml-4 ${this.state.activeTab === 'general' ? 'active' : ''}`}  
                                        color="primary" onClick={() => {
                                            this.toggle('general');
                                        }}>
                                    General
                                </NavLink>
                            </NavItem>
                            <NavItem>
                                <NavLink className={`mt-2 ml-4 ${this.state.activeTab === 'documents' ? 'active' : ''}`}  
                                        color="primary" onClick={() => {
                                            this.toggle('documents');
                                        }}>
                                    Documents
                                </NavLink>
                            </NavItem>
                        </Nav>

                        <TabContent activeTab={this.state.activeTab}>
                                                                        
                            <TabPane tabId="general">

                                <div className="row">

                                    <div style={ { minWidth: "999px", maxWidth: '999px' } } className="col-md-9">

                                <FormGroup className="mb-2" row>
                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Purchase Order #</Label>
                                        <Input type="text" value={ this.state.id } disabled={ true } />
                                    </Col>
                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Today's Date</Label>
                                        <Input type="date" name="todaysdate" value={ this.state.todaysdate } onChange={ this.change } />
                                    </Col>
                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Date Required</Label>
                                        <Input type="date" name="datereqd" value={ this.state.datereqd } onChange={ this.change } />
                                    </Col>
                                </FormGroup>

                                <FormGroup className="mb-2" row>
                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">To</Label>
                                        <div style={ { minWidth: '290px'} } className="d-flex justify-content-between">
                                            
                                            <Select
                                                className="w-100"
                                                classNamePrefix="mw-290"
                                                styles={ { maxWidth: '290px' } }
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

                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Phone</Label>
                                        <Input type="text" name="phone" value={ this.state.phone } onChange={ this.changePhone } />
                                    </Col>

                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Extension</Label>
                                        <Input type="text" name="extension" value={ this.state.extension } onChange={ this.change } />
                                    </Col>

                                </FormGroup>

                                <FormGroup className="mb-2" row>

                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Contact</Label>
                                        <div className="d-flex" style={ { minWidth: '250px' } }>
                                            <Select 
                                                className="w-100"
                                                name="contact" 
                                                value={ contactSelected } 
                                                defaultValue={ contactSelected } 
                                                onChange={ this.selectContact } 
                                                options={ contactOptions } 
                                            />
                                            <Contact 
                                                contacts={ contacts } 
                                                to={ to } 
                                                select={ this.selected } 
                                                update={ this.updateContact } 
                                                save={ this.addContact } 
                                                delete={ this.deleteContact }
                                                />
                                        </div>
                                    </Col>

                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Fax</Label>
                                        <Input type="text" name="fax" value={ this.state.fax } onChange={ this.changePhone } />
                                    </Col>

                                </FormGroup>

                                <FormGroup className="mb-2" row>

                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Email</Label>
                                        <Input  style={ { minWidth: '265px' } } type="text" name="email" value={ this.state.email } onChange={ this.change } />  
                                    </Col>

                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Cellphone</Label>
                                        <Input type="text" name="cellphone" value={ this.state.cellphone } onChange={ this.changePhone } />
                                    </Col>

                                </FormGroup>

                                {/* <FormGroup row>
                                    <Col md={6}>
                                        <Row>
                                            <Col>
                                                
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
                                            
                                        </Row>
                                        
                                        <Row className="mt-3">
                                            
                                        </Row>
                                    </Col>
                                    
                                </FormGroup>

                       

                                <FormGroup row>
                                    
                                   
                                   
                                    

                                    </FormGroup> */}

                                

                                <FormGroup row>
                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Shipping Company</Label>
                                        <Input type="text" name="shippingco" value={ this.state.shippingco } onChange={ this.change } />
                                    </Col>
                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">Ship</Label>
                                        <Input type="select" name="ship" value={ this.state.ship } onChange={ this.change }>
                                            <option value="Pickup">Pickup</option>
                                            <option value="Ship Via">Ship Via</option>
                                        </Input>
                                    </Col>
                                    <Col md={4} className="form-inline">
                                        <Label className="mr-2">For</Label>                               
                                        <Input type="text" name="for" value={ this.state.for } onChange={ this.change } />    
                                    </Col>
                                </FormGroup>

                                {/* <Row className="mb-4">
                                    <Col>
                                        <Label>For</Label>                               
                                        <Input type="text" name="for" value={ this.state.for } onChange={ this.change } />    
                                    </Col>
                                </Row> */}

                                <Row>

                                    <Col md={11}>

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

                                        </Col>

                                </Row>

                                

                                <FormGroup row>
                                    <Col md={11}>
                                        <Label>Ship To</Label>
                                        <Input type="textarea" rows="8" name="shipTo" value={ this.state.shipTo } onChange={ this.change } />
                                    </Col>
                                </FormGroup>

                                <FormGroup row>
                                    <Col md={11}>
                                        <Label>Comments</Label>
                                        <Input type="textarea" rows="5" name="comments" value={ this.state.comments } onChange={ this.change } />

                                    </Col>
                                </FormGroup>

                                </div>

                                </div>
                            
                            </TabPane>

                            <TabPane tabId="documents">

                                <Documents 
                                    id={ this.state.id } 
                                    documents={ this.state.documents } 
                                    upload={ this.upload }
                                    delete={ this.deleteDocument }
                                    />

                            </TabPane>

                        </TabContent>

                    </CardBody>
                    <CardFooter className="d-flex justify-content-end">

                        { this.state.activeTab === 'general' ?

                        <Button onClick={ this.save } color="primary">Save</Button>

                        : '' }
                        
                    </CardFooter>
                </Card>

                
                <ReactTooltip />


            </Fragment>

        )

    }

}

class Documents extends Component {

    constructor( props ) {

        super( props );

        this.onDrop = this.onDrop.bind(this);
        this.open = this.open.bind(this);

    }

    open( document ) {

        const url = `/storage/purchase-orders/${this.props.id}/${document.filename}`;
    
        const win = window.open( url );
    
        win.focus();
    
      }

    onDrop(files) {

        const Files = files;
  
        const data = new FormData();
  
        Files.map( (file) => {
  
          data.append( 'documents', file );
  
        })

        this.props.upload( data );
  
        
  
    }

    render() {

        const data = this.props.documents.map( (d, index) => {

            d.index = index + 1;
            d.actions = <Fragment>
                          <Button data-tip="Open" onClick={ () => this.open( d ) } className="mr-1" color="primary"><FontAwesomeIcon icon={faFilePdf} /> Open</Button>
                          <Button data-tip="Delete" onClick={ () => this.props.delete( d ) } color="danger"><FontAwesomeIcon icon={faTrash} /> Delete</Button>
                        </Fragment>
      
            return d;
      
          });

          const columns = [
                    {
                      dataField: 'index',
                      text: '#'
                    },
                    {
                      dataField: 'filename',
                      text: 'Filename'
                    },
                    {
                      dataField: 'actions',
                      text: 'Actions'
                    }
                  ];

        return (

            <Fragment>

                <Dropzone onDrop={this.onDrop}>
                            {({getRootProps, getInputProps}) => (
                                <section className="mb-4">
                                <div {...getRootProps({className: 'dropzone p-4'})}>
                                    <input {...getInputProps()} />
                                    <p>Drag 'n' drop some files here, or click to select files</p>
                                </div>                  
                                </section>
                            )}
                </Dropzone>

                <BootstrapTable 
                    keyField='id' 
                    columns={ columns } 
                    data={ data } striped hover />

            </Fragment>

        )

    }

}

class Email extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            email: '',
            message: '',
            open: false,
            sending: false,

        }

        this.save = this.save.bind(this);
        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.change = this.change.bind(this);

    }

    email( data ) {

        data.id = this.props.id;

        this.setState( { sending: true }, () => {

            Authservice.sendPurchaseOrderEmail( data )
            .then( response => {

                if ( response.success ) {

                    this.setState( { open: false, sending: false } );

                }

            })

        } );

        

    }


    change( e ) {

        this.setState( { [e.target.name] : e.target.value } );

    }

    save() {

        this.email( this.state );

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }


    render() {

        return (

            <Fragment>

                <Button data-tip="Email" onClick={ this.open } className="mr-1" color="info"><FontAwesomeIcon icon={faEnvelope} /></Button>

                <Modal isOpen={ this.state.open } toggle={ this.close } className="mw-100 w-50">
                    <ModalHeader>
                        Email
                    </ModalHeader>
                    <ModalBody>

                        <FormGroup>
                            <Label>Email</Label>
                            <Input type="email" name="email" onChange={ this.change } />
                        </FormGroup>

                        {/* <FormGroup>
                            <Label>Message / Notes</Label>
                            <Input type="textarea" name="message" onChange={ this.change } />
        </FormGroup> */}

                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={ this.save } color="success"><FontAwesomeIcon icon={faPaperPlane} /> { this.state.sending ? 'Sending, please wait... ' : 'Send' }</Button> <Button color="light" onClick={ this.close }><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal>

            </Fragment>

        )

    }

}