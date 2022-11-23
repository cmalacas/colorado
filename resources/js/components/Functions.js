import React, { Fragment, useState, useEffect } from 'react';

import {
    Row, Col,
    Button,
    Input, Table
} from 'reactstrap';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faAngleLeft, faAngleDoubleLeft, faAngleRight, faAngleDoubleRight } from '@fortawesome/free-solid-svg-icons'

export const format_date = (date) => {

    const str = date.split('-');

    const year = str[0];
    const month = str[1];
    const day = str[2];

    const months = {
        '01' : 'Jan',
        '02' : 'Feb',
        '03' : 'Mar',
        '04' : 'Apr',
        '05' : 'May',
        '06' : 'Jun',
        '07' : 'Jul',
        '08' : 'Aug',
        '09' : 'Sep',
        '10' : 'Oct',
        '11' : 'Nov',
        '12' : 'Dec'
    }

    return `${day}-${months[month]}-${year}`

}

export const format_datetime = (datetime, dateOnly = false) => {

    let date = [];

    if (datetime) {

        if (datetime.indexOf('T') >= 1) {

            date = datetime.split('T');

        } else {

            date = datetime.split(' ');

        }

        const str = date[0].split('-');

        const time = date[1] ? date[1].split(':') : ['00', '00'];
        
        let am = 'AM';

        const year = str[0];
        const month = str[1];
        const day = str[2];

        let hr = time[0];
        let min = time[1];

        if (parseInt(hr) > 12) {

            am = 'PM';

            hr = parseInt(hr) - 12;

            if (hr < 10) {

                hr = `0${hr}`;
            }

        }

        const months = {
            '00' : '00',
            '01' : 'Jan',
            '02' : 'Feb',
            '03' : 'Mar',
            '04' : 'Apr',
            '05' : 'May',
            '06' : 'Jun',
            '07' : 'Jul',
            '08' : 'Aug',
            '09' : 'Sep',
            '10' : 'Oct',
            '11' : 'Nov',
            '12' : 'Dec'
        }

        if (dateOnly) {

            return `${day}-${months[month]}-${year}`

        } else {

            return `${day}-${months[month]}-${year} ${hr}:${min} ${am}`

        }

    } else {

        return 'Not Specified'

    }

}

export const formatter = new Intl.NumberFormat('en-UK', {
    style: 'currency',
    currency: 'GBP',
    minimumFractionDigits: 2
});

export const validateEmail = (email) => {
    
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    return re.test(String(email).toLowerCase());

}

export const validatePhone = (phone) => {

    const reg = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3,4})[-. ]?([0-9]{4})$/;  
      
    return reg.exec(phone);          

}

export const Pager = (page, totalSize, item_Per_Page, callback, select) => {

        let first = '';
        let prev = '';
        let next = '';
        
        const diff = totalSize % item_Per_Page;

        let total_page = parseInt(totalSize / item_Per_Page);

        if (diff > 0) {
            total_page++;
        }       

        const options = [];

        let last = <Button data-tip="Last" onClick={() => callback(total_page)} color="light" className="rounded-0"><FontAwesomeIcon icon={faAngleDoubleRight} /></Button>;

        if (page  < total_page) {
            next = <Button data-tip="Next" color="light" onClick={() => callback(page + 1)} className="next-btn rounded-0"><FontAwesomeIcon icon={faAngleRight} /></Button>
        }

        if (page > 1) {
            prev = <Button data-tip="Previous" color="light" onClick={ () => callback( page - 1)} className="prev-btn rounded-0"><FontAwesomeIcon icon={faAngleLeft} /></Button>
            first = <Button data-tip="First" color="light" onClick={ () => callback( 1 ) }  className="first-btn rounded-0"><FontAwesomeIcon icon={faAngleDoubleLeft} /></Button>
        }

        for(let i=1; i<= total_page; i += 1) options.push(i)


        const dropdown = <Input data-tip="Select" onChange={ select }  value={page} className="d-inline rounded-0 w-25" type="select">
                            {options.map( i => {
                                return <option value={i}>{i}</option>
                            })}
                        </Input>

        return (
            <Row className="pager mt-2 mb-2">
                <Col md={3} className="offset-md-9 d-flex justify-content-end">
                {first}{prev}{dropdown}{next}{last}
                </Col>
            </Row>
        )
}


export const buildTable = (data, columns, sortField, sortOrder, sort_callback) => {

    const thead = <thead><tr>
                        {
                            columns.map( c => {
                                return (
                                    <th

                                        style={ c.style } 

                                        className={ 
                                            c.sort ?  

                                                sortField === c.dataField ?

                                                    sortOrder === 'asc' ? 'sort-asc' : 'sort-desc'

                                                :
                                            
                                            `sortable`                                                             
                                            
                                            : `` 
                                    
                                        }

                                        onClick={ c.sort ?  () => sort_callback( c.dataField ) : '' }

                                    >
                                        {c.text}
                                    </th>
                                )
                            })
                        }
                  </tr></thead>

    const tbody = <tbody>
                    {
                        data.map( d => {

                            let values = columns.map( c => {

                                return (

                                    <td style={ c.style } className={c.classes}>{d[`${c.dataField}`]}</td>
                                )

                            });                          

                            return (

                                <tr className={d.class}>
                                    { values }
                                </tr>

                            )

                        })
                    }
                  </tbody>

    return (

        <Fragment>
            <Table striped bordered hover>
                { thead }
                { tbody }
            </Table>
        </Fragment>

    )
}

export const format_time = (time) => {

    const str = time.split(':');

    const hr = parseInt(str[0]);

    if (hr === 12) {
        return <Fragment>
            { hr }:{str[1]} PM
        </Fragment>
    } else if ( hr > 12 ) {
        return <Fragment>
            { hr - 12}:{str[1]} PM
        </Fragment>
    } else {
        return <Fragment>
            { hr }:{ str[1]} AM
        </Fragment>
    }

}

export const Loading = () => {
    return (
        
            <div className="loading">
                <div className="img">
                    <img src="/images/loader.gif" />
                </div>
            </div>
        
    )
}

export const range = (start, stop, step) => {
    
    var a = [start], b = start;
    
    while (b < stop) {
        a.push(b += step || 1);
    }

    return (b > stop) ? a.slice(0,-1) : a;
}

export const example = () => {

    const [count, setCount] = useState(0);

  // Similar to componentDidMount and componentDidUpdate:
  useEffect(() => {
    // Update the document title using the browser API
    document.title = `You clicked ${count} times`;
  });

  return (
    <div>
      <p>You clicked {count} times</p>
      <button onClick={() => setCount(count + 1)}>
        Click me
      </button>
    </div>
  );

}

export const countries = [
    {Title:"United Kingdom",Code:"+44"},
    {Title:"Afghanistan",Code:"+93"},
    {Title:"\xc5land Islands",Code:"+358"},
    {Title:"Albania",Code:"+355"},
    {Title:"Algeria",Code:"+213"},
    {Title:"American Samoa",Code:"+1684"},
    {Title:"Andorra",Code:"+376"},
    {Title:"Angola",Code:"+244"},
    {Title:"Anguilla",Code:"+1264"},
    {Title:"Antarctica",Code:"+672"},
    {Title:"Antigua and Barbuda",Code:"+1268"},
    {Title:"Argentina",Code:"+54"},
    {Title:"Armenia",Code:"+374"},
    {Title:"Aruba",Code:"+297"},
    {Title:"Australia",Code:"+61"},
    {Title:"Austria",Code:"+43"},
    {Title:"Azerbaijan",Code:"+994"},
    {Title:"Bahamas",Code:"+1242"},
    {Title:"Bahrain",Code:"+973"},
    {Title:"Bangladesh",Code:"+880"},
    {Title:"Barbados",Code:"+1246"},
    {Title:"Belarus",Code:"+375"},
    {Title:"Belgium",Code:"+32"},
    {Title:"Belize",Code:"+501"},
    {Title:"Benin",Code:"+229"},
    {Title:"Bermuda",Code:"+1441"},
    {Title:"Bhutan",Code:"+975"},
    {Title:"Bolivia, Plurinational State of bolivia",Code:"+591"},
    {Title:"Bosnia and Herzegovina",Code:"+387"},
    {Title:"Botswana",Code:"+267"},
    {Title:"Bouvet Island",Code:"+47"},
    {Title:"Brazil",Code:"+55"},
    {Title:"British Indian Ocean Territory",Code:"+246"},
    {Title:"Brunei Darussalam",Code:"+673"},
    {Title:"Bulgaria",Code:"+359"},
    {Title:"Burkina Faso",Code:"+226"},
    {Title:"Burundi",Code:"+257"},
    {Title:"Cambodia",Code:"+855"},
    {Title:"Cameroon",Code:"+237"},
    {Title:"Canada",Code:"+1"},
    {Title:"Cape Verde",Code:"+238"},
    {Title:"Cayman Islands",Code:"+ 345"},
    {Title:"Central African Republic",Code:"+236"},
    {Title:"Chad",Code:"+235"},
    {Title:"Chile",Code:"+56"},
    {Title:"China",Code:"+86"},
    {Title:"Christmas Island",Code:"+61"},
    {Title:"Cocos (Keeling) Islands",Code:"+61"},
    {Title:"Colombia",Code:"+57"},
    {Title:"Comoros",Code:"+269"},
    {Title:"Congo",Code:"+242"},
    {Title:"Congo, The Democratic Republic of the Congo",Code:"+243"},
    {Title:"Cook Islands",Code:"+682"},
    {Title:"Costa Rica",Code:"+506"},
    {Title:"Cote d'Ivoire",Code:"+225"},
    {Title:"Croatia",Code:"+385"},
    {Title:"Cuba",Code:"+53"},
    {Title:"Cyprus",Code:"+357"},
    {Title:"Czech Republic",Code:"+420"},
    {Title:"Denmark",Code:"+45"},
    {Title:"Djibouti",Code:"+253"},
    {Title:"Dominica",Code:"+1767"},
    {Title:"Dominican Republic",Code:"+1849"},
    {Title:"Ecuador",Code:"+593"},
    {Title:"Egypt",Code:"+20"},
    {Title:"El Salvador",Code:"+503"},
    {Title:"Equatorial Guinea",Code:"+240"},
    {Title:"Eritrea",Code:"+291"},
    {Title:"Estonia",Code:"+372"},
    {Title:"Ethiopia",Code:"+251"},
    {Title:"Falkland Islands (Malvinas)",Code:"+500"},
    {Title:"Faroe Islands",Code:"+298"},
    {Title:"Fiji",Code:"+679"},
    {Title:"Finland",Code:"+358"},
    {Title:"France",Code:"+33"},
    {Title:"French Guiana",Code:"+594"},
    {Title:"French Polynesia",Code:"+689"},
    {Title:"French Southern Territories",Code:"+262"},
    {Title:"Gabon",Code:"+241"},
    {Title:"Gambia",Code:"+220"},
    {Title:"Georgia",Code:"+995"},
    {Title:"Germany",Code:"+49"},
    {Title:"Ghana",Code:"+233"},
    {Title:"Gibraltar",Code:"+350"},
    {Title:"Greece",Code:"+30"},
    {Title:"Greenland",Code:"+299"},
    {Title:"Grenada",Code:"+1473"},
    {Title:"Guadeloupe",Code:"+590"},
    {Title:"Guam",Code:"+1671"},
    {Title:"Guatemala",Code:"+502"},
    {Title:"Guernsey",Code:"+44"},
    {Title:"Guinea",Code:"+224"},
    {Title:"Guinea-Bissau",Code:"+245"},
    {Title:"Guyana",Code:"+592"},
    {Title:"Haiti",Code:"+509"},
    {Title:"Heard Island and Mcdonald Islands",Code:"+0"},
    {Title:"Holy See (Vatican City State)",Code:"+379"},
    {Title:"Honduras",Code:"+504"},
    {Title:"Hong Kong",Code:"+852"},
    {Title:"Hungary",Code:"+36"},
    {Title:"Iceland",Code:"+354"},
    {Title:"India",Code:"+91"},
    {Title:"Indonesia",Code:"+62"},
    {Title:"Iran, Islamic Republic of Persian Gulf",Code:"+98"},
    {Title:"Iraq",Code:"+964"},
    {Title:"Ireland",Code:"+353"},
    {Title:"Isle of Man",Code:"+44"},
    {Title:"Israel",Code:"+972"},
    {Title:"Italy",Code:"+39"},
    {Title:"Jamaica",Code:"+1876"},
    {Title:"Japan",Code:"+81"},
    {Title:"Jersey",Code:"+44"},
    {Title:"Jordan",Code:"+962"},
    {Title:"Kazakhstan",Code:"+7"},
    {Title:"Kenya",Code:"+254"},
    {Title:"Kiribati",Code:"+686"},
    {Title:"Korea, Democratic People's Republic of Korea",Code:"+850"},
    {Title:"Korea, Republic of South Korea",Code:"+82"},
    {Title:"Kosovo",Code:"+383"},
    {Title:"Kuwait",Code:"+965"},
    {Title:"Kyrgyzstan",Code:"+996"},
    {Title:"Laos",Code:"+856"},
    {Title:"Latvia",Code:"+371"},
    {Title:"Lebanon",Code:"+961"},
    {Title:"Lesotho",Code:"+266"},
    {Title:"Liberia",Code:"+231"},
    {Title:"Libyan Arab Jamahiriya",Code:"+218"},
    {Title:"Liechtenstein",Code:"+423"},
    {Title:"Lithuania",Code:"+370"},
    {Title:"Luxembourg",Code:"+352"},
    {Title:"Macao",Code:"+853"},
    {Title:"Macedonia",Code:"+389"},
    {Title:"Madagascar",Code:"+261"},
    {Title:"Malawi",Code:"+265"},
    {Title:"Malaysia",Code:"+60"},
    {Title:"Maldives",Code:"+960"},
    {Title:"Mali",Code:"+223"},
    {Title:"Malta",Code:"+356"},
    {Title:"Marshall Islands",Code:"+692"},
    {Title:"Martinique",Code:"+596"},
    {Title:"Mauritania",Code:"+222"},
    {Title:"Mauritius",Code:"+230"},
    {Title:"Mayotte",Code:"+262"},
    {Title:"Mexico",Code:"+52"},
    {Title:"Micronesia, Federated States of Micronesia",Code:"+691"},
    {Title:"Moldova",Code:"+373"},
    {Title:"Monaco",Code:"+377"},
    {Title:"Mongolia",Code:"+976"},
    {Title:"Montenegro",Code:"+382"},
    {Title:"Montserrat",Code:"+1664"},
    {Title:"Morocco",Code:"+212"},
    {Title:"Mozambique",Code:"+258"},
    {Title:"Myanmar",Code:"+95"},
    {Title:"Namibia",Code:"+264"},
    {Title:"Nauru",Code:"+674"},
    {Title:"Nepal",Code:"+977"},
    {Title:"Netherlands",Code:"+31"},
    {Title:"Netherlands Antilles",Code:"+599"},
    {Title:"New Caledonia",Code:"+687"},
    {Title:"New Zealand",Code:"+64"},
    {Title:"Nicaragua",Code:"+505"},
    {Title:"Niger",Code:"+227"},
    {Title:"Nigeria",Code:"+234"},
    {Title:"Niue",Code:"+683"},
    {Title:"Norfolk Island",Code:"+672"},
    {Title:"Northern Mariana Islands",Code:"+1670"},
    {Title:"Norway",Code:"+47"},
    {Title:"Oman",Code:"+968"},
    {Title:"Pakistan",Code:"+92"},
    {Title:"Palau",Code:"+680"},
    {Title:"Palestinian Territory, Occupied",Code:"+970"},
    {Title:"Panama",Code:"+507"},
    {Title:"Papua New Guinea",Code:"+675"},
    {Title:"Paraguay",Code:"+595"},
    {Title:"Peru",Code:"+51"},
    {Title:"Philippines",Code:"+63"},
    {Title:"Pitcairn",Code:"+64"},
    {Title:"Poland",Code:"+48"},
    {Title:"Portugal",Code:"+351"},
    {Title:"Puerto Rico",Code:"+1939"},
    {Title:"Qatar",Code:"+974"},
    {Title:"Romania",Code:"+40"},
    {Title:"Russia",Code:"+7"},
    {Title:"Rwanda",Code:"+250"},
    {Title:"Reunion",Code:"+262"},
    {Title:"Saint Barthelemy",Code:"+590"},
    {Title:"Saint Helena, Ascension and Tristan Da Cunha",Code:"+290"},
    {Title:"Saint Kitts and Nevis",Code:"+1869"},
    {Title:"Saint Lucia",Code:"+1758"},
    {Title:"Saint Martin",Code:"+590"},
    {Title:"Saint Pierre and Miquelon",Code:"+508"},
    {Title:"Saint Vincent and the Grenadines",Code:"+1784"},
    {Title:"Samoa",Code:"+685"},
    {Title:"San Marino",Code:"+378"},
    {Title:"Sao Tome and Principe",Code:"+239"},
    {Title:"Saudi Arabia",Code:"+966"},
    {Title:"Senegal",Code:"+221"},
    {Title:"Serbia",Code:"+381"},
    {Title:"Seychelles",Code:"+248"},
    {Title:"Sierra Leone",Code:"+232"},
    {Title:"Singapore",Code:"+65"},
    {Title:"Slovakia",Code:"+421"},
    {Title:"Slovenia",Code:"+386"},
    {Title:"Solomon Islands",Code:"+677"},
    {Title:"Somalia",Code:"+252"},
    {Title:"South Africa",Code:"+27"},
    {Title:"South Sudan",Code:"+211"},
    {Title:"South Georgia and the South Sandwich Islands",Code:"+500"},
    {Title:"Spain",Code:"+34"},
    {Title:"Sri Lanka",Code:"+94"},
    {Title:"Sudan",Code:"+249"},
    {Title:"Suriname",Code:"+597"},
    {Title:"Svalbard and Jan Mayen",Code:"+47"},
    {Title:"Swaziland",Code:"+268"},
    {Title:"Sweden",Code:"+46"},
    {Title:"Switzerland",Code:"+41"},
    {Title:"Syrian Arab Republic",Code:"+963"},
    {Title:"Taiwan",Code:"+886"},
    {Title:"Tajikistan",Code:"+992"},
    {Title:"Tanzania, United Republic of Tanzania",Code:"+255"},
    {Title:"Thailand",Code:"+66"},
    {Title:"Timor-Leste",Code:"+670"},
    {Title:"Togo",Code:"+228"},
    {Title:"Tokelau",Code:"+690"},
    {Title:"Tonga",Code:"+676"},
    {Title:"Trinidad and Tobago",Code:"+1868"},
    {Title:"Tunisia",Code:"+216"},
    {Title:"Turkey",Code:"+90"},
    {Title:"Turkmenistan",Code:"+993"},
    {Title:"Turks and Caicos Islands",Code:"+1649"},
    {Title:"Tuvalu",Code:"+688"},
    {Title:"Uganda",Code:"+256"},
    {Title:"Ukraine",Code:"+380"},
    {Title:"United Arab Emirates",Code:"+971"},
    {Title:"United States",Code:"+1"},
    {Title:"Uruguay",Code:"+598"},
    {Title:"Uzbekistan",Code:"+998"},
    {Title:"Vanuatu",Code:"+678"},
    {Title:"Venezuela, Bolivarian Republic of Venezuela",Code:"+58"},
    {Title:"Vietnam",Code:"+84"},
    {Title:"Virgin Islands, British",Code:"+1284"},
    {Title:"Virgin Islands, U.S.",Code:"+1340"},
    {Title:"Wallis and Futuna",Code:"+681"},
    {Title:"Yemen",Code:"+967"},
    {Title:"Zambia",Code:"+260"},
    {Title:"Zimbabwe",Code:"+263"}];


export const phone_number_check = (e) => {

    const field = e.target;
        
    var key_code = e.keyCode,
        key_string = String.fromCharCode(key_code),
        press_delete = false,
        dash_key = 189,
        delete_key = [8,46],
        direction_key = [33,34,35,36,37,38,39,40],
        selection_end = field.selectionEnd;
    
    // delete key was pressed
    if (delete_key.indexOf(key_code) > -1) {
        press_delete = true;
    }
    
    // only force formatting is a number or delete key was pressed
    if (key_string.match(/^\d+$/) || press_delete) {
        phone_formatting(field,press_delete);
    }
    // do nothing for direction keys, keep their default actions
    else if(direction_key.indexOf(key_code) > -1) {
        // do nothing
    }
    else if(dash_key === key_code) {
        if (selection_end === field.value.length) {
        field.value = field.value.slice(0,-1)
        }
        else {
        field.value = field.value.substring(0,(selection_end - 1)) + field.value.substr(selection_end)
        field.selectionEnd = selection_end - 1;
        }
    }
    // all other non numerical key presses, remove their value
    else {
        e.preventDefault();
    //    field.value = field.value.replace(/[^0-9\-]/g,'')
        return phone_formatting(e,'revert');
    }
    
}

export const phone_formatting = (ele,restore) => {
    var new_number,
        selection_start = ele.selectionStart,
        selection_end = ele.selectionEnd,
        number = ele.target.value.replace(/\D/g,'');
    
    // automatically add dashes
    if (number.length > 2) {
      // matches: 123 || 123-4 || 123-45
      new_number = number.substring(0,3) + '-';
      if (number.length === 4 || number.length === 5) {
        // matches: 123-4 || 123-45
        new_number += number.substr(3);
      }
      else if (number.length > 5) {
        // matches: 123-456 || 123-456-7 || 123-456-789
        new_number += number.substring(3,6) + '-';
      }
      if (number.length > 6) {
        // matches: 123-456-7 || 123-456-789 || 123-456-7890
        new_number += number.substring(6);
      }
    }
    else {
      new_number = number;
    }
    
    // if value is heigher than 12, last number is dropped
    // if inserting a number before the last character, numbers
    // are shifted right, only 12 characters will show
    ele.value =  (new_number.length > 12) ? new_number.substring(0,12) : new_number;
    
    // restore cursor selection,
    // prevent it from going to the end
    // UNLESS
    // cursor was at the end AND a dash was added
    // document.getElementById('msg').innerHTML='<p>Selection is: ' + selection_end + ' and length is: ' + new_number.length + '</p>';
    
    if (new_number.slice(-1) === '-' && restore === false
        && (new_number.length === 8 && selection_end === 7)
            || (new_number.length === 4 && selection_end === 3)) {
        selection_start = new_number.length;
        selection_end = new_number.length;
    }
    else if (restore === 'revert') {
      selection_start--;
      selection_end--;
    }

    return new_number;
    
    //return ele.setSelectionRange(selection_start, selection_end);
  
  }

