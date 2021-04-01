                  <div class="form-group">
                       <label for="title">Title</label>
                       <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $story->title)}}">
                       @error('title')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                       
                       @enderror
                   </div>
                   
                     <div class="form-group">
                       <label for="body">Body</label>
                      <textarea name="body" class="form-control @error('body') is-invalid @enderror">
                           {{ old('body', $story->body)}}
                      </textarea>
                      
                       @error('body')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                       
                       @enderror
                   </div>
                   
                     <div class="form-group">
                       <label for="type">Type</label>
                       <select name="type" id="" class="form-control @error('type') is-invalid @enderror">
                           <option value="">--Select Type--</option>
                           <option value="short" {{'short' == old('type', $story->type) ? 'selected' : ''}}>Short</option>
                           <option value="long" {{'long' == old('type', $story->type) ? 'selected' : ''}}>Long</option>
                         
                       </select>
                    @error('type')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                    </span>

                    @enderror
                   </div>
                   
                   <div class="form-group">
                        <legend>
                            <h6>Status</h6>
                        </legend>
                        <div class="form-check @error('type') is-invalid @enderror">
                        <input type="radio" class="form-check-input" value="1" {{'1' == old('status', $story->status) ? 'checked' : ''}} name="status">
                        <label for="active" class="form-check-label">Yes</label>
                        </div>
                        
                        <div class="form-check" >
                        <input type="radio" class="form-check-input" value="0" {{'0' == old('status', $story->status) ? 'checked' : ''}}  name="status">
                        <label for="active" class="form-check-label">No</label>
                        </div>
                        
                         @error('status')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                       
                       @enderror
                       
                   </div>
                   
                   <div class="form-group">
                       <label for="image">Image</label>
                       <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                       @error('image')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                       
                       @enderror
                       <img src="{{$story->Thumbnails}}" alt="image">
                   </div>
                   
                   <div class="form-group">
                      @if(count($tags) > 0)
                       @foreach($tags as $tag)
                       
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="tags[]" value="{{$tag->id}}" {{ in_array( $tag->id, old('tags', $story->tags->pluck('id')->toArray()) ) ? 'checked' : "" }} >
                                <label class="form-check-label">
                                    {{$tag->name}}
                                </label>
                            </div>
                           
                       @endforeach
                       @endif
                   </div>
                   
                    