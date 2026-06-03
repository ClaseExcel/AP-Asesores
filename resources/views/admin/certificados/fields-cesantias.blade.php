   <div class="row">
       <div class="col-12 col-md-6">
           <div class="form-floating mb-3">
               <select name="concepto" id="concepto" class="form-select">
                   <option value="">Selecciona una opción</option>
                   @foreach ($conceptos as $key => $tipo)
                       <option value="{{ $key }}" {{ old('concepto', '') == $key ? 'selected' : '' }}>
                           {{ $tipo }}
                       </option>
                   @endforeach
               </select>
               <label for="concepto" class="fw-normal">Concepto <b class="text-danger">*</b></label>
               @error('concepto')
                   <p class="text-danger">{{ $message }}</p>
               @enderror
           </div>
       </div>
   </div>
