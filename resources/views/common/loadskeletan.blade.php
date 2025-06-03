 @php
    $loopCount = $loopCount ?? 'default_name';
   
@endphp
 
 @for ($i = 0; $i < $loopCount; $i++)
     <tr>
         <td class="placeholder-wave" style="padding:16px">
             <div class="placeholder rounded" style="width:99%; height:20px; background:#0000001f; padding:10px">
             </div>
         </td>
         <td class="placeholder-wave" style="padding:16px">
             <div class="placeholder rounded" style="width:99%; height:20px; background:#00000038"></div>
         </td>
         <td class="placeholder-wave" style="padding:16px" colspan='100%'>
             <div class="placeholder rounded" style="width:99%; height:20px; background:#00000045"></div>
         </td>
     </tr>
 @endfor
