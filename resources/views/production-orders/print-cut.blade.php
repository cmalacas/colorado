<div style="display: flex">

    <div class="section-title" style="margin-right:10px; line-height:5; color: #cc6600">Cut</div>

    <div style="border: solid 2px #cc6600; padding:0 10px; margin-bottom:10px; vertical-align:top; width:100%">

      <h2>STOCK: {{ $data['ColoEnvStock'] }}</H2>

      <table width="100%" cellspacing=0 border=0>

        <thead>
          <tr>
            <td style="border-bottom:solid 1px #000;">&nbsp;</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 12px;">Die Size</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 12px;">Sheet Roll / Size</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 12px;">#Out</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 12px;">Die #</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 12px;">Flat / Pull Size</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 12px;">Seal Flap Size</td>
          </tr>
        </thead>
        <tbody>

          @if(!empty($data['out_diagonal_die_size']) ||
              !empty($data['out_diagonal_sheet_size']) ||
              !empty($data['out_diagonal_number_out']) ||
              !empty($data['out_diagonal_die_number']) ||
              !empty($data['out_diagonal_seal_flap_size'])
            )

          <tr>
            <td style="font-size: 12px; padding:3px 0;">Diagonals</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_diagonal_die_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_diagonal_sheet_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_diagonal_number_out'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_diagonal_die_number'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;">&nbsp;</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_diagonal_seal_flap_size'] }}</td>
          </tr>

          @endif

          @if(!empty($data['out_mo_booklet_die_size']) ||
              !empty($data['out_mo_booklet_sheet_size']) || 
              !empty($data['out_mo_booklet_number_out']) ||
              !empty($data['out_mo_booklet_die_number']) || 
              !empty($data['out_mo_booklet_flat_size']) || 
              !empty($data['out_mo_booklet_seal_flap_size'])
            )
          <tr>
            <td style="font-size: 12px; padding:3px 0;">MO Booklet</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_die_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_sheet_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_number_out'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_die_number'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_flat_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_seal_flap_size'] }}</strong></td>
          </tr>
          @endif

          @if(!empty($data['out_mo_catalog_die_size']) ||
              !empty($data['out_mo_catalog_sheet_size']) ||
              !empty($data['out_mo_catalog_number_out']) ||
              !empty($data['out_mo_catalog_die_number']) ||
              !empty($data['out_mo_catalog_flat_size']) ||
              !empty($data['out_mo_catalog_seal_flap_size'])
            )
          <tr>
            <td style="font-size: 12px; padding:3px 0;">MO Catalog</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_die_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_sheet_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_number_out'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_die_number'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_flat_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_seal_flap_size'] }}</strong></td>
          </tr>
          @endif

          @if(!empty($data['out_side_seam_die_size']) ||
              !empty($data['out_side_seam_sheet_size']) ||
              !empty($data['out_side_seam_number_out']) ||
              !empty($data['out_side_seam_die_number']) ||
              !empty($data['out_side_seam_flat_size']) ||
              !empty($data['out_side_seam_seal_flap_size'])
          )
          <tr>
            <td style="font-size: 12px; padding:3px 0;">Outside Seam</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_side_seam_die_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_side_seam_sheet_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_side_seam_number_out'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_side_seam_die_number'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_side_seam_flat_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['out_side_seam_seal_flap_size'] }}</strong></td>
          </tr>
          @endif

          @if(!empty($data['adjustable_die_size']) || 
              !empty($data['adjustable_sheet_size']) || 
              !empty($data['adjustable_number_out']) || 
              !empty($data['adjustable_die_number']) || 
              !empty($data['adjustable_flat_size']) || 
              !empty($data['adjustable_seal_flap_size'])
          )
          <tr>
            <td style="font-size: 12px; padding:3px 0;">Adjustable</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['adjustable_die_size'] }}</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['adjustable_sheet_size'] }}</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['adjustable_number_out'] }}</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['adjustable_die_number'] }}</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['adjustable_flat_size'] }}</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['adjustable_seal_flap_size'] }}</td>
          </tr>
          @endif

          @if(!empty($data['web_ro_die_size']) ||
              !empty($data['web_ro_sheet_size']) || 
              !empty($data['web_ro_number_out']) ||
              !empty($data['web_ro_die_number']) ||
              !empty($data['web_ro_flat_size']) ||
              !empty($data['web_ro_seal_flap_size'])
            )
          <tr>
            <td style="font-size: 12px; padding:3px 0;">WEB - RA</td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['web_ro_die_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['web_ro_sheet_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['web_ro_number_out'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['web_ro_die_number'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['web_ro_flat_size'] }}</strong></td>
            <td style="font-size: 12px; padding:3px 0;"><strong>{{ $data['web_ro_seal_flap_size'] }}</strong></td>
          </tr>
          @endif
        </tbody>

      </table>

    </div>

  </div>