!function(){document.querySelector("dropzone");var e=document.querySelector(".registration__file-zone"),i=document.querySelector(".adding-post__file-zone--photo"),t=document.querySelector(".adding-post__file-zone--video"),a=document.querySelectorAll('input[type="file"]');if(a)for(var l=0;l<a.length;l++)a[l].addEventListener("click",function(e){e.preventDefault()});if(Dropzone.autoDiscover=!1,e)new Dropzone(".registration__file-zone",{url:"#",maxFiles:1,init:function(){this.on("addedfile",function(){null!=this.files[1]&&this.removeFile(this.files[0])})},clickable:".form__input-file-button",maxFilesize:null,maxThumbnailFilesize:50,thumbnailWidth:null,thumbnailHeight:null,previewsContainer:".dropzone-previews",acceptedFiles:"image/*",parallelUploads:1,autoProcessQueue:!1,previewTemplate:'<div class="dz-preview dz-file-preview"><div class="registration__image-wrapper form__file-wrapper"><img class="form__image" src="" alt="" data-dz-thumbnail></div><div class="registration__file-data form__file-data"><span class="registration__file-name form__file-name dz-filename" data-dz-name></span><button class="registration__delete-button form__delete-button button" type="button" data-dz-remove><span>Удалить</span><svg class="registration__delete-icon form__delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="12" height="12"><path d="M18 1.3L16.7 0 9 7.7 1.3 0 0 1.3 7.7 9 0 16.7 1.3 18 9 10.3l7.7 7.7 1.3-1.3L10.3 9z"/></svg></button></div></div>'});if(i)new Dropzone(".adding-post__file-zone--photo",{url:"#",maxFiles:1,init:function(){this.on("addedfile",function(){null!=this.files[1]&&this.removeFile(this.files[0])})},clickable:".form__input-file-button--photo",maxFilesize:null,maxThumbnailFilesize:50,thumbnailWidth:null,thumbnailHeight:null,previewsContainer:".adding-post__file--photo",acceptedFiles:"image/*",parallelUploads:1,autoProcessQueue:!1,previewTemplate:'<div class="dz-preview dz-file-preview"><div class="adding-post__image-wrapper form__file-wrapper"> <img class="form__image" src="" alt="" data-dz-thumbnail> </div> <div class="adding-post__file-data form__file-data"> <span class="adding-post__file-name form__file-name dz-filename" data-dz-name></span> <button class="adding-post__delete-button form__delete-button button" type="button" data-dz-remove> <span>Удалить</span> <svg class="adding-post__delete-icon form__delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="12" height="12"><path d="M18 1.3L16.7 0 9 7.7 1.3 0 0 1.3 7.7 9 0 16.7 1.3 18 9 10.3l7.7 7.7 1.3-1.3L10.3 9z"/></svg> </button> </div></div>'});if(t)new Dropzone(".adding-post__file-zone--video",{url:"#",maxFiles:1,init:function(){this.on("addedfile",function(){null!=this.files[1]&&this.removeFile(this.files[0])})},clickable:".form__input-file-button--video",maxFilesize:null,maxThumbnailFilesize:50,thumbnailWidth:null,thumbnailHeight:null,previewsContainer:".adding-post__file--video",acceptedFiles:"image/*",parallelUploads:1,autoProcessQueue:!1,previewTemplate:'<div class="dz-preview dz-file-preview"><div class="adding-post__video-wrapper form__file-wrapper form__file-wrapper--video"> <img class="form__image" src="" alt="" data-dz-thumbnail> </div> <div class="adding-post__file-data form__file-data"> <span class="adding-post__file-name form__file-name dz-filename" data-dz-name></span> <button class="adding-post__delete-button form__delete-button button" type="button" data-dz-remove> <span>Удалить</span> <svg class="adding-post__delete-icon form__delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="12" height="12"><path d="M18 1.3L16.7 0 9 7.7 1.3 0 0 1.3 7.7 9 0 16.7 1.3 18 9 10.3l7.7 7.7 1.3-1.3L10.3 9z"/></svg> </button> </div></div>'})}();