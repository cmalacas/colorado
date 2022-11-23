import React, { Component, Fragment } from 'react';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

import { faSearch, faSync, faBan } from '@fortawesome/free-solid-svg-icons'

import { Button, Modal, ModalBody, ModalHeader, ModalFooter, Input, Label, FormGroup } from 'reactstrap';

export default class SearchPurchaseOrder extends Component {

  constructor( props ) {

    super( props );

  }

  reload() {

    location = '/purchase-orders';

  }

  render() {

    return (

      <Fragment>
        <Search />
        <Button onClick={ this.reload } className="ml-1" color="primary"><FontAwesomeIcon icon={faSync} /></Button>
      </Fragment>

    )
  }
}

class Search extends Component {

  constructor( props ) {

    super( props );

    this.state = {

      open: false,

      keywords: '',
      field: 'todays-date',
      match: 'any',
      
      errorKeywords: false,

    }

    this.open = this.open.bind(this);
    this.close = this.close.bind(this);
    this.change = this.change.bind(this);
    this.search = this.search.bind(this);

  }

  search() {

    let valid = true;
    let errorKeywords = false;

    const { keywords, field, match } = this.state;

    if (keywords === '') {

      valid = false;
      errorKeywords = true;

    }

    if ( valid ) {

      location = `/purchase-orders/search/${keywords}/${field}/${match}`

    } else {

      this.setState( { errorKeywords } );

    }

  }

  change( e ) {

    this.setState( { [e.target.name] : e.target.value, errorKeywords: false } );

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
        <Button onClick={this.open} color="primary"><FontAwesomeIcon icon={faSearch} /></Button>
        <Modal isOpen={this.state.open} toggle={this.close}>
          <ModalHeader>
            Search Purchase Order
          </ModalHeader>
          <ModalBody>
            <FormGroup>
              <Label>Find What</Label>
              <Input type="text" name="keywords" value={this.state.keywords} onChange={this.change} />
              { this.state.errorKeywords ? <div className="alert alert-danger">This is required</div> : '' }
            </FormGroup>
            <FormGroup>
              <Label>Look In</Label>
              <Input type="select" name="field" value={this.state.field} onChange={this.change}>
                <option value="todays-date">Today's Date</option>
                <option value="date-required">Date Required</option>
                <option value="to">To</option>
                <option value="contact">Contact</option>
                <option value="address">Address</option>
                <option value="for">For</option>
                <option value="email">Email</option>
                <option value="phone">Phone</option>
                <option value="extension">Extension</option>
                <option value="fax">Fax</option>
                <option value="cellphone">Cellphone</option>
                <option value="shipping-company">Shipping Company</option>
                <option value="ship">Ship</option>
                <option value="description">Description</option>
                <option value="comments">Comments</option>                
              </Input>
            </FormGroup>
            <FormGroup>
              <Label>Match</Label>
              <Input type="select" name="match" value={this.state.match} onChange={this.change}>
                <option value="any">Any Part of Field</option>
                <option value="whole">Whole Field</option>
                <option value="start">Start of Field</option>
              </Input>
            </FormGroup>
          </ModalBody>
          <ModalFooter>
            <Button onClick={this.search} color="primary"><FontAwesomeIcon icon={faSearch} /> Search</Button>
            <Button onClick={this.close} color="light"><FontAwesomeIcon icon={faBan} /> Close</Button>
          </ModalFooter>
        </Modal>
      </Fragment>

    )

  }
}