@php $counter = 0; @endphp
@foreach($contacts as $contact)
<tr id="contact-row{{ $counter }}">
  <td>
    <input type="hidden" name="contact[{{ $counter }}][id]" value="{{ $contact->id }}">
    <input type="text" name="contact[{{ $counter }}][name]" value="{{ $contact->name }}" class="form-control">
  </td>
  <td>
    <input type="text" name="contact[{{ $counter }}][email]" value="{{ $contact->email }}" class="form-control">
  </td>
  <td>
    <input type="text" name="contact[{{ $counter }}][phone]" value="{{ $contact->phone }}" class="contact-phone form-control">
    <input type="text" name="contact[{{ $counter }}][ext]" value="{{ $contact->phone_ext }}" class="form-control contact-phone-ext">
  </td>
  <td>
    <input type="text" name="contact[{{ $counter }}][mobile]" value="{{ $contact->mobile }}" class="contact-phone mobile form-control">
  </td>
  <td>
    <input type="text" name="contact[{{ $counter }}][fax]" value="{{ $contact->fax }}" class="contact-phone fax form-control">
  </td>
  <td>
    <a class="btn btn-danger" href="#" data-id="{{ $counter }}"><i class="fa fa-trash"></i></a>
  </td>
</tr>
@php $counter++; @endphp
@endforeach