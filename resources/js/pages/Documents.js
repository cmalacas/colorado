import Axios from 'axios';
import React, { Component, Fragment, useCallback } from 'react';
import Dropzone from 'react-dropzone';

import Authservice from '../components/Authservice';

import BootstrapTable from 'react-bootstrap-table-next';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faFilePdf, faTrash } from '@fortawesome/free-solid-svg-icons';

import ReactTooltip from 'react-tooltip';

import { Button } from 'reactstrap';

export default class Documents extends Component {

  constructor( props ) {

    super( props );

    this.state = {

      documents: [],
      production_order_id: 0,

    }

    this.getDocuments = this.getDocuments.bind(this);   
    this.onDrop = this.onDrop.bind(this);
    this.open = this.open.bind(this);
    this.delete = this.delete.bind(this);
  
  }  

  open( document ) {

    const url = `/storage/pdf/${this.state.production_order_id}/${document.filename}`;

    const win = window.open( url );

    win.focus();

  }

  delete( document ) {

    const documents = this.state.documents.filter( d => d.id != document.id );

    this.setState( { documents } );

    Authservice.deleteDocument( { id: document.id } );

  }

  onDrop(files) {

      const Files = files;

      const data = new FormData();

      Files.map( (file) => {

        data.append( 'documents', file );

      })

      const id = this.state.production_order_id;
      
      Axios.post('/documents/' + id + '/upload', data )
      .then( response => {

          this.getDocuments();

      })

      

  }

  getDocuments() {

    const production_order_id = this.props.match.params.id;

    Authservice.getDocuments( { id: production_order_id } )
    .then( response => {

      if ( response.documents ) {

        this.setState( { documents: response.documents, production_order_id } );

      }

    })

  }

  componentDidMount() {

    this.getDocuments();

    ReactTooltip.rebuild();

  }

  render() {

    const data = this.state.documents.map( (d, index) => {

      d.index = index + 1;
      d.actions = <Fragment>
                    <Button data-tip="Open" onClick={ () => this.open( d ) } className="mr-1" color="primary"><FontAwesomeIcon icon={faFilePdf} /> Open</Button>
                    <Button data-tip="Delete" onClick={ () => this.delete( d ) } color="danger"><FontAwesomeIcon icon={faTrash} /> Delete</Button>
                  </Fragment>

      return d;

    })

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

        <ReactTooltip />

      </Fragment>

    )

  }

}