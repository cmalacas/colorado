import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import React, { Component, Fragment } from 'react';

import { FormGroup, Input, Button, Modal, ModalBody, ModalFooter, ModalHeader, Label, Col, Row, Nav, NavItem, NavLink, TabPane, TabContent } from 'reactstrap';

import { faUsers, faTrash, faEdit, faCheck, faPlus } from '@fortawesome/free-solid-svg-icons';
import ReactTooltip from 'react-tooltip';
import Authservice from '../components/Authservice';
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory, { PaginationProvider} from 'react-bootstrap-table2-paginator';
import filterFactory, { textFilter } from 'react-bootstrap-table2-filter';
import 'react-bootstrap-table2-paginator/dist/react-bootstrap-table2-paginator.min.css';

import classnames from 'classnames';

import { Add, Edit } from './Customers';

export default class Contact extends Component {

  constructor( props ) {

    super( props );

    this.state = {
      open: false,
      customers: [],
      contacts: [],
      shiptos: [],
      new_contact: { name: '', phone: '', extension: '', fax: '', email: '' }
    }

    this.open = this.open.bind(this);
    this.close = this.close.bind(this);
    this.select = this.select.bind(this);
    this.addCustomer = this.addCustomer.bind(this);
    this.updateCustomer = this.updateCustomer.bind(this);
  }

  updateCustomer( data ) {

    Authservice.updateCustomer( data )
    .then( response => {

        if (response.customers) {

            this.setState({ 
                customers: response.customers, 
                contacts: response.contacts,
                shiptos: response.shiptos
            });

        }

    })

}

  addCustomer( data ) {
    Authservice.saveCustomer( data )
    .then( response => {
      if ( response.customers ) {
        this.setState( {
          customers: response.customers,
          contacts: response.contacts,
          shiptos: response.shiptos
        });
      }
    })
  }

  select( customer ) {

    const customer_id = customer.id;

    const evt = new Event('change');    

    const element = document.getElementById('CustomerId');

    let options = '';

    this.state.customers.map( m => {

      options += `<option value="${m.id}">${m.name}</option>`

    })

    element.innerHTML = options;

    element.value = customer_id;    

    element.dispatchEvent(evt);

    this.setState( { open: false } );
    
  }

  open() {
    this.setState( { open: true } );
  }

  close() {
    this.setState( { open: false } ) ;
  }

  componentDidMount() {
    Authservice.getCustomers()
    .then( response => {
      if (response.customers) {
        this.setState({ 
            customers: response.customers,
            contacts: response.contacts,
            shiptos: response.shiptos
          });
      }
    })
  }

  render() {

    const columns = [
      {
        dataField: 'index',
        text: '#',
        style: { width: '50px' },
        headerStyle: { width: '50px' }
      },
      {
        dataField: 'name',
        text: 'Customer Name',
        filter: textFilter( { className: "d-block"} )
      },
      {
        dataField: 'actions',
        text: 'Actions',
        style: { width: '150px' },
        headerStyle: { width: '150px' }
      }
    ];

    const data = this.state.customers.map( (c, index) => {

      const contacts = this.state.contacts.filter( cc => cc.customer_id === c.id )
      const shiptos = this.state.shiptos.filter( s => s.customer_id === c.id )

      c.index = index + 1;
      c.actions = <Fragment>
                    <Edit 
                      customer={ c }
                      contacts={ contacts }
                      shiptos={ shiptos }
                      save={ this.updateCustomer }
                    /> 
                      <Button className="mr-1" onClick={ () => this.select( c ) } color="success">
                        <FontAwesomeIcon icon={faCheck} />
                      </Button> 
                      <Button color="danger">
                        <FontAwesomeIcon icon={faTrash} />
                      </Button>
                  </Fragment>

      return c;

    });

    const paginationOption = {
      custom: true,
      totalSize: data.length
    };

    return (

      <Fragment>
        <Button onClick={ this.open } data-tip="Select customer" color="primary"><FontAwesomeIcon icon={faUsers} /></Button>
        <Modal isOpen={ this.state.open } toggle={ this.close } className="mw-100 w-50">
          <div className="modal-header d-flex justify-content-between">
            <h5>Customers</h5>
            <Add
              save={ this.addCustomer } 
            />
          </div>
          <ModalBody>
            <BootstrapTable 
              keyField="id"
              columns={ columns }
              data={ data }
              pagination={ paginationFactory() }
              filter={ filterFactory() }
            />
          </ModalBody>
          <ModalFooter>
            <Button onClick={ this.close }>Close</Button>
          </ModalFooter>
        </Modal>
        <ReactTooltip />
      </Fragment>

    )

  }
}

class AddCustomer extends Component {

  constructor( props ) {

    super( props );

    this.state = {
      open: false,
      activeTab: 'contacts',
      name: '',
      row: 0,
      contacts: [],
      error: false
    }

    this.open = this.open.bind(this);
    this.close = this.close.bind(this);
    this.toggle = this.toggle.bind(this);
    this.save = this.save.bind(this);
    this.change = this.change.bind(this);
    this.addContact = this.addContact.bind(this);
    this.contactUpdate = this.contactUpdate.bind(this);
  }

  contactUpdate( e, row ) {

    console.log(e.target.value, row);

    const contacts = this.state.contacts.map( c => {

      if ( c.id === row.id ) {

        c.name = e.target.value;

      }

      return c;

    });

    this.setState( { contacts } );

  }

  addContact() {
    const row = this.state.row + 1;
    const contact = { id: row, name: '', email: '', phone: '', ext: '', fax: '' };
    const contacts = this.state.contacts;

    contacts.push( contact );

    this.setState( { contacts, row } );

  }

  change(e) {
    this.setState( { name: e.target.value, error: false } );
  }

  save() {

    const name = this.state.name;
    
    let error = false;
    let valid = true;

    if ( name === '' ) {
      valid = false;
      error = true;
    }

    if ( valid ) {
      this.props.save( { name } );
      this.setState( { open: false } );
    } else {
      this.setState( { error } );
    }

  }

  toggle( activeTab ) {
    this.setState( { activeTab } );
  }

  open() {
    this.setState( { open: true } );
  }

  close() {
    this.setState( { open: false } ) ;
  }

  render() {

    const contact_columns = [
        {
          dataField: 'name',
          text: 'Name',
          formatter: (cell, row)  => {

            return <Input placeholder="Enter contact name" value={cell} onChange={ (e) => this.contactUpdate(e, row) } type="text" />

          }
        },
        {
          dataField: 'email',
          text: 'Email'
        },
        { 
          dataField: 'phone_ext',	
          text: 'Phone/Ext'
        },
        {
          dataField: 'mobile',
          text: 'Mobile'
        },
        {
          dataField: 'fax',
          text: 'Fax'
        }
      ];

    const contact_data = this.state.contacts;

    const shipto_columns = [
            {
              text: 'Ship To',
              dataField: 'shipto'
            },
            {
              text: 'Address 1',
              dataField: 'address1'
            },
            {
              text: 'Address 2',
              dataField: 'address2'
            },
            {
              text: 'City',
              dataField: 'city'
            },
            {
              text: 'State',
              dataField: 'state'
            },
            {
              text: 'Zip',
              dataField: 'zip'
            },
            {
              text: 'Attn',
              dataField: 'attn'
            },
            {
              text: 'Phone',
              dataField: 'phone'
            }
      
      ];

    const shipto_data = [];

    return (

      <Fragment>
        <Button onClick={ this.open } data-tip="Add Customer" color="primary">Add Customer</Button>
        <Modal isOpen={ this.state.open } toggle={ this.close } className="mw-100 w-75">
          <ModalHeader>Add Customer</ModalHeader>
          <ModalBody>
            <FormGroup row>
              <Col md={6}>
                <Label>Customer Name</Label>
                <Input type="text" name="name" value={ this.state.name } onChange={ this.change } />
                { this.state.error ?  <div classsName="alert alert-danger">This is required</div>: '' }
              </Col>
              
            </FormGroup>
            <Row>
              <Col>
                <Nav tabs>
                  <NavItem>
                    <NavLink
                      className={classnames( {active: this.state.activeTab === 'contacts'} )}
                      onClick={() => this.toggle('contacts')}
                    >
                      Contacts
                    </NavLink>
                  </NavItem>
                  <NavItem>
                    <NavLink
                      className={classnames( {active: this.state.activeTab === 'shipto'} )}
                      onClick={() => this.toggle('shipto')}
                    >
                      ShipTo
                    </NavLink>
                  </NavItem>
                </Nav>
                <TabContent activeTab={ this.state.activeTab}>
                  <TabPane tabId="contacts">
                    <Row className="pt-2 pb-2">
                      <Col>
                        <BootstrapTable 
                          keyField="id"
                          columns={contact_columns}
                          data={contact_data}
                        />
                      </Col>
                    </Row>
                    <Row>
                      <Col className="text-right"><Button onClick={ this.addContact } color="primary"><FontAwesomeIcon icon={faPlus} /></Button></Col>
                    </Row>
                  </TabPane>
                  <TabPane tabId="shipto">
                    <Row className="pt-2 pb-2">
                      <Col>
                          <BootstrapTable 
                            keyField="id"
                            columns={shipto_columns}
                            data={shipto_data}
                          />
                      </Col>                      
                    </Row>
                  </TabPane>
                </TabContent>
              </Col>
            </Row>
          </ModalBody>
          <ModalFooter>
            <Button onClick={ this.save } color="primary">Save</Button>
            <Button onClick={ this.close }>Close</Button>
          </ModalFooter>
        </Modal>        
      </Fragment>

    )

  }

}

class EditCustomer extends Component {

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
    this.setState( { open: false } ) ;
  }

  render() {

    return (

      <Fragment>
        <Button onClick={ this.open } data-tip="Add Customer" color="primary"><FontAwesomeIcon icon={faEdit} /></Button>
        <Modal isOpen={ this.state.open } toggle={ this.close } className="mw-100 w-75">
          <ModalHeader>Edit Customer</ModalHeader>
          <ModalBody>

          </ModalBody>
          <ModalFooter>
            <Button color="primary">Save</Button>
            <Button onClick={ this.close }>Close</Button>
          </ModalFooter>
        </Modal>        
      </Fragment>

    )
  }
}