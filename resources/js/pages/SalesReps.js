import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import React, { Component, Fragment } from 'react';

import { FormGroup, Input, Button, Modal, ModalBody, ModalFooter, ModalHeader, Label, Col, Row, Nav, NavItem, NavLink, TabPane, TabContent } from 'reactstrap';

import { faUsers, faTrash, faEdit, faCheck, faPlus } from '@fortawesome/free-solid-svg-icons';
import ReactTooltip from 'react-tooltip';
import Authservice from '../components/Authservice';

import { validateEmail } from '../components/Functions';

export default class SalesReps extends Component {

  constructor( props ) {

    super( props );

    this.state = {
      open: false,
      name: '',
      email: '',
      phone: '',
      customerId: 0,
      errorName: false,
      errorEmail: false,
    }

    this.open = this.open.bind(this);
    this.close = this.close.bind(this);
    this.change = this.change.bind(this);
    this.changePhone = this.changePhone.bind(this);
    this.save = this.save.bind(this);
  }

  changePhone(e) {

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

          console.log('phone_number', phone_number)

      } else {

          phone_number = number;

      }

      this.setState( { phone: phone_number } );

  }

  save() {

    let valid = true;
    let errorName = false;
    let errorEmail = false;

    const { name, email, phone, customerId  } = this.state;

    if (name == '') {

      valid = false;
      errorName = true;

    }

    if (email != '' && validateEmail(email) == false)  {

      valid = false;
      errorEmail = true;

    }

    if (valid) {

      Authservice.saveSalesRep( { name, email, phone, customerId } )
      .then( response => {

        if (response.salesreps) {

          const salesreps = response.salesreps;

          let options = '';

          salesreps.map( s => {
            options += `<option value="${s.name}">${s.name}</option>`;
          });

          const evt = new Event('change');    

          const element = document.getElementById('SalesRep');

          element.innerHTML = options;

          element.value = name;    

          element.dispatchEvent(evt);

          this.setState( { open: false } );

        }

      })


    } else {

      this.setState({ errorName, errorEmail });

    }

    

  }

  change( e ) {

    this.setState({ [e.target.name]: e.target.value, errorName: false, errorEmail: false });

  }

  


  select( customer ) {

    const evt = new Event('change');    

    const element = document.getElementById('SalesRep');

    element.value = customer.name;    

    element.dispatchEvent(evt);

    this.setState( { open: false } );
    
  }

  open() {

    const customerId = document.getElementById('CustomerId').value;

    this.setState( { open: true, customerId } );
  }

  close() {
    this.setState( { open: false } ) ;
  }

  componentDidMount() {

    
    
  }

  render() {

   
    

    return (

      <Fragment>
        <Button onClick={ this.open } data-tip="Select customer" color="primary"><FontAwesomeIcon icon={faPlus} /></Button>
        <Modal isOpen={ this.state.open } toggle={ this.close }>
          <ModalHeader toggle={this.close}>Add Sales Rep</ModalHeader>
          <ModalBody>
            <FormGroup>
              <Label for="name">Name</Label>
              <Input type="text" id="name" name="name" placeholder="Name" onChange={ this.change } />
              { this.state.errorName ? <div className="alert alert-danger">This is required</div> : '' }
            </FormGroup>
            <FormGroup>
              <Label for="phone">Phone</Label>
              <Input type="text" id="phone" name="phone" placeholder="Phone" onChange={ this.changePhone } value={ this.state.phone } />
            </FormGroup>            
            <FormGroup>
              <Label for="email">Email</Label>
              <Input type="text" id="email" name="email" placeholder="Email" onChange={ this.change } />
              { this.state.errorEmail ? <div className="alert alert-danger">Invalid email</div> : '' }
            </FormGroup>
            <FormGroup>
              <Button color="primary" onClick={this.save}>Save</Button>
            </FormGroup>
          </ModalBody>
        </Modal>
        <ReactTooltip />
      </Fragment>

    )

  }
}

