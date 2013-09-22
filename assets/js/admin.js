$(document).ready(function(){

    //Simple delete confirmation script
    var deleteMe = function(){
        return confirm('Are you sure you want to delete this?') ? true : false;
    };
    $('.confirmDelete').click(deleteMe);
    
    //Enable the galleries to be sortable
    $('#categoryIndex, #projectGallery').sortable({
        handle: '.handle'
    });
    
    //Add a current page marker to the navigation
    var url = window.location;
    $('.navbar a').filter(function() {
        return this.href == url;
    }).addClass('current-page');

    //settings of the upload form
    Dropzone.options.galleryDropzone = {
        maxFilesize: 5, // MB
        previewTemplate: "<li class='dz-preview dz-file-preview'><div class='dz-details thumbnails'><div class='dz-filename'><span data-dz-name></span></div><div class='dz-size' data-dz-size></div><img class='uploadedFile' data-dz-thumbnail /><div class='dz-progress'><span class='dz-upload' data-dz-uploadprogress></span></div><div class='dz-success-mark'><span>✔</span></div><div class='dz-error-mark'><span>✘</span></div><div class='dz-error-message'><span data-dz-errormessage></span></div></div></li>",
        accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
              done("Naha, you don't.");
            }
            else { done(); }
        },
        init: function() {
            //on a success full upload make the img usefull/clickable in it's contexts
            this.on("success", function(file) {
                //TODO; refactor this, it's a mess!
                $(file.previewElement).click(function(){
                    var type = $('#uploadType').val();
                    var imgBaseDir = $('#' + type + 'ImgBaseDir').val();
                    var imgName = file.name;
                    var imgSrc = imgBaseDir + "/medium/" + imgName;
                    if(type == 'gallery'){
                        var slideGallery = $('#slideGallery');
                        var foundSlide = slideGallery.find('li[id="slideImg_' + imgName + '"]');
                        if(foundSlide.length > 0)
                        {
                            //if found remove it
                            foundSlide.remove();
                        } else {
                            //else add it
                            var imgSlideClone = $(imgSlideTemplate).clone();
                            imgSlideClone.attr('id','slideImg_'+imgName);
                            imgSlideClone.find('img').attr('src',imgSrc);
                            imgSlideClone.find('input[name="slideContent[]"]').attr('value',imgName);
                            slideGallery.append(imgSlideClone);
                            FnImgGallery.makeSortable();
                            FnImgGallery.swapImage('#slideGallery','#imgLibrary');
                            this.remove();
                        }

                    } else {
                        $('#'+type).val(imgName);
                        $('.index-'+type+' > img').attr('src',imgSrc);
                    }
                    return false;
                });
            });
        }
    };

    //TODO: make this one function..
    $('.use-foreground-form').click(function(){
        $('#uploadDir').val('foregroundUploadDir');
        $('#uploadType').val('foreground');
    });
    $('.use-background-form').click(function(){
        $('#uploadDir').val('backgroundUploadDir');
        $('#uploadType').val('background');
    });
    $('.use-logo-form').click(function(){
        $('#uploadDir').val('logoUploadDir');
        $('#uploadType').val('logo');
        selectLogo();
    });

    //sets the logo alignment class [theme admin page]
    var selectLogo = function (){
        var initalAlignment = $('#logoAlignClass').val();
        $('.index-logo.'+initalAlignment).addClass('selected');
    }
    selectLogo();
    $('.index-logo').click(function(){
        var cssClasses = $(this).attr("class");
        logoAlignClass = cssClasses.split(' ')[1];
        $('#logoAlignClass').val(logoAlignClass);
        $('.index-logo').removeClass('selected');
        $(this).addClass('selected');
    });

    FnImgGallery.makeSortable();
    FnImgGallery.index('foreground');
    FnImgGallery.index('background');
    FnImgGallery.index('logo');
    FnImgGallery.destroy('Gallery',deleteMe);
    FnImgGallery.destroy('Foreground',deleteMe);
    FnImgGallery.destroy('Background',deleteMe);
    FnImgGallery.destroy('Logo',deleteMe);
    //init the clickability of the library image to add to the gallery or remove it
    FnImgGallery.swapImage('#slideGallery','#imgLibrary');
    FnImgGallery.swapImage('#imgLibrary','#slideGallery',true);
});

FnImgGallery = {

    //TODO: some function to directly add the uploaded images
    //TODO: make it more configurable
    swapImage: function(source,target,disable){
        $(source+' li.swap').click(function(){
            var li = $(this);
            li.appendTo($(target));
            if(disable === true){
                li.find('input').removeAttr('disabled');
                FnImgGallery.swapImage(target,source);
            } else {
                li.find('input').attr('disabled','disabled');
                FnImgGallery.swapImage(target,source,true);
            }
            FnImgGallery.makeSortable();
        });
    },
    //Make the list drag/sortable
    makeSortable: function(){
        $('#slideGallery').sortable();
    },
    //Use the image as src for 'type'
    index: function(type){
        $('#'+type+'Library li[id^="imgLib_"]').click(function(){
            //var imgBaseDir = $('#' + type + 'ImgBaseDir').val();
            var imgSrc = $(this).find('img').attr('src');
            var index = imgSrc.lastIndexOf('/');
            var imgName = imgSrc.substring(index+1);
            $('#'+type).val(imgName);
            $('.index-'+type+' > img').attr('src',imgSrc);
            return false;
        });
     },
    //Delete an image
    destroy: function(type,confirmFunc){
        $('#deleteImagesForm #delete'+type+'Library li[id^="imgLib_"]').click(function(){
            //get the filename
            var imgSrc = $(this).find('img').attr('src');
            var index = imgSrc.lastIndexOf('/');
            var imgName = imgSrc.substring(index+1);
            //give the user a change to reconsider
            if(confirmFunc()===true){
                //send request to remove the image
                $.post("deleteImage", 
                        { _token: $('input[name="_token"]').val(), 
                            filename: imgName,
                            type: type } );
                //remove from the DOM
                $(this).remove();
            }
            return false;
        });
    }
};


/* HTML5 Sortable (http://farhadi.ir/projects/html5sortable)
 * Released under the MIT license.
 */(function(a){var b,c=a();a.fn.sortable=function(d){var e=String(d);return d=a.extend({connectWith:!1},d),this.each(function(){if(/^enable|disable|destroy$/.test(e)){var f=a(this).children(a(this).data("items")).attr("draggable",e=="enable");e=="destroy"&&f.add(this).removeData("connectWith items").off("dragstart.h5s dragend.h5s selectstart.h5s dragover.h5s dragenter.h5s drop.h5s");return}var g,h,f=a(this).children(d.items),i=a("<"+(/^ul|ol$/i.test(this.tagName)?"li":"div")+' class="sortable-placeholder">');f.find(d.handle).mousedown(function(){g=!0}).mouseup(function(){g=!1}),a(this).data("items",d.items),c=c.add(i),d.connectWith&&a(d.connectWith).add(this).data("connectWith",d.connectWith),f.attr("draggable","true").on("dragstart.h5s",function(c){if(d.handle&&!g)return!1;g=!1;var e=c.originalEvent.dataTransfer;e.effectAllowed="move",e.setData("Text","dummy"),h=(b=a(this)).addClass("sortable-dragging").index()}).on("dragend.h5s",function(){b.removeClass("sortable-dragging").show(),c.detach(),h!=b.index()&&f.parent().trigger("sortupdate",{item:b}),b=null}).not("a[href], img").on("selectstart.h5s",function(){return this.dragDrop&&this.dragDrop(),!1}).end().add([this,i]).on("dragover.h5s dragenter.h5s drop.h5s",function(e){return!f.is(b)&&d.connectWith!==a(b).parent().data("connectWith")?!0:e.type=="drop"?(e.stopPropagation(),c.filter(":visible").after(b),!1):(e.preventDefault(),e.originalEvent.dataTransfer.dropEffect="move",f.is(this)?(d.forcePlaceholderSize&&i.height(b.outerHeight()),b.hide(),a(this)[i.index()<a(this).index()?"after":"before"](i),c.not(i).detach()):!c.is(this)&&!a(this).children(d.items).length&&(c.detach(),a(this).append(i)),!1)})})}})(jQuery);

/* Dropzone (http://www.dropzonejs.com/)
 * Ajax file uploads
 */!function(){function a(b,c,d){var e=a.resolve(b);if(null==e){d=d||b,c=c||"root";var f=new Error('Failed to require "'+d+'" from "'+c+'"');throw f.path=d,f.parent=c,f.require=!0,f}var g=a.modules[e];return g.exports||(g.exports={},g.client=g.component=!0,g.call(this,g.exports,a.relative(e),g)),g.exports}a.modules={},a.aliases={},a.resolve=function(b){"/"===b.charAt(0)&&(b=b.slice(1));for(var c=[b,b+".js",b+".json",b+"/index.js",b+"/index.json"],d=0;d<c.length;d++){var b=c[d];if(a.modules.hasOwnProperty(b))return b;if(a.aliases.hasOwnProperty(b))return a.aliases[b]}},a.normalize=function(a,b){var c=[];if("."!=b.charAt(0))return b;a=a.split("/"),b=b.split("/");for(var d=0;d<b.length;++d)".."==b[d]?a.pop():"."!=b[d]&&""!=b[d]&&c.push(b[d]);return a.concat(c).join("/")},a.register=function(b,c){a.modules[b]=c},a.alias=function(b,c){if(!a.modules.hasOwnProperty(b))throw new Error('Failed to alias "'+b+'", it does not exist');a.aliases[c]=b},a.relative=function(b){function c(a,b){for(var c=a.length;c--;)if(a[c]===b)return c;return-1}function d(c){var e=d.resolve(c);return a(e,b,c)}var e=a.normalize(b,"..");return d.resolve=function(d){var f=d.charAt(0);if("/"==f)return d.slice(1);if("."==f)return a.normalize(e,d);var g=b.split("/"),h=c(g,"deps")+1;return h||(h=0),d=g.slice(0,h+1).join("/")+"/deps/"+d},d.exists=function(b){return a.modules.hasOwnProperty(d.resolve(b))},d},a.register("component-emitter/index.js",function(a,b,c){function d(a){return a?e(a):void 0}function e(a){for(var b in d.prototype)a[b]=d.prototype[b];return a}c.exports=d,d.prototype.on=function(a,b){return this._callbacks=this._callbacks||{},(this._callbacks[a]=this._callbacks[a]||[]).push(b),this},d.prototype.once=function(a,b){function c(){d.off(a,c),b.apply(this,arguments)}var d=this;return this._callbacks=this._callbacks||{},b._off=c,this.on(a,c),this},d.prototype.off=d.prototype.removeListener=d.prototype.removeAllListeners=function(a,b){this._callbacks=this._callbacks||{};var c=this._callbacks[a];if(!c)return this;if(1==arguments.length)return delete this._callbacks[a],this;var d=c.indexOf(b._off||b);return~d&&c.splice(d,1),this},d.prototype.emit=function(a){this._callbacks=this._callbacks||{};var b=[].slice.call(arguments,1),c=this._callbacks[a];if(c){c=c.slice(0);for(var d=0,e=c.length;e>d;++d)c[d].apply(this,b)}return this},d.prototype.listeners=function(a){return this._callbacks=this._callbacks||{},this._callbacks[a]||[]},d.prototype.hasListeners=function(a){return!!this.listeners(a).length}}),a.register("dropzone/index.js",function(a,b,c){c.exports=b("./lib/dropzone.js")}),a.register("dropzone/lib/dropzone.js",function(a,b,c){!function(){var a,d,e,f,g,h,i={}.hasOwnProperty,j=function(a,b){function c(){this.constructor=a}for(var d in b)i.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},k=[].slice,l=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};d="undefined"!=typeof Emitter&&null!==Emitter?Emitter:b("emitter"),g=function(){},a=function(a){function b(a,d){var e,f,g;if(this.element=a,this.version=b.version,this.defaultOptions.previewTemplate=this.defaultOptions.previewTemplate.replace(/\n*/g,""),this.clickableElements=[],this.listeners=[],this.files=[],this.acceptedFiles=[],this.filesQueue=[],this.filesProcessing=[],"string"==typeof this.element&&(this.element=document.querySelector(this.element)),!this.element||null==this.element.nodeType)throw new Error("Invalid dropzone element.");if(this.element.dropzone)throw new Error("Dropzone already attached.");if(b.instances.push(this),a.dropzone=this,e=null!=(g=b.optionsForElement(this.element))?g:{},this.options=c({},this.defaultOptions,e,null!=d?d:{}),null==this.options.url&&(this.options.url=this.element.action),!this.options.url)throw new Error("No URL provided.");if(this.options.acceptParameter&&this.options.acceptedMimeTypes)throw new Error("You can't provide both 'acceptParameter' and 'acceptedMimeTypes'. 'acceptParameter' is deprecated.");return this.options.method=this.options.method.toUpperCase(),this.options.forceFallback||!b.isBrowserSupported()?this.options.fallback.call(this):((f=this.getExistingFallback())&&f.parentNode&&f.parentNode.removeChild(f),this.previewsContainer=this.options.previewsContainer?b.getElement(this.options.previewsContainer,"previewsContainer"):this.element,this.options.clickable&&(this.clickableElements=this.options.clickable===!0?[this.element]:b.getElements(this.options.clickable,"clickable")),this.init(),void 0)}var c;return j(b,a),b.prototype.events=["drop","dragstart","dragend","dragenter","dragover","dragleave","selectedfiles","addedfile","removedfile","thumbnail","error","processingfile","uploadprogress","totaluploadprogress","sending","success","complete","reset"],b.prototype.defaultOptions={url:null,method:"post",withCredentials:!1,parallelUploads:2,maxFilesize:256,paramName:"file",createImageThumbnails:!0,maxThumbnailFilesize:10,thumbnailWidth:100,thumbnailHeight:100,params:{},clickable:!0,acceptedMimeTypes:null,acceptParameter:null,enqueueForUpload:!0,previewsContainer:null,dictDefaultMessage:"Drop files here to upload",dictFallbackMessage:"Your browser does not support drag'n'drop file uploads.",dictFallbackText:"Please use the fallback form below to upload your files like in the olden days.",dictFileTooBig:"File is too big ({{filesize}}MB). Max filesize: {{maxFilesize}}MB.",dictInvalidFileType:"You can't upload files of this type.",dictResponseError:"Server responded with {{statusCode}} code.",accept:function(a,b){return b()},init:function(){return g},forceFallback:!1,fallback:function(){var a,c,d,e,f,g;for(this.element.className=""+this.element.className+" dz-browser-not-supported",g=this.element.getElementsByTagName("div"),e=0,f=g.length;f>e;e++)a=g[e],/(^| )message($| )/.test(a.className)&&(c=a,a.className="dz-message");return c||(c=b.createElement('<div class="dz-message"><span></span></div>'),this.element.appendChild(c)),d=c.getElementsByTagName("span")[0],d&&(d.textContent=this.options.dictFallbackMessage),this.element.appendChild(this.getFallbackForm())},resize:function(a){var b,c,d;return b={srcX:0,srcY:0,srcWidth:a.width,srcHeight:a.height},c=a.width/a.height,d=this.options.thumbnailWidth/this.options.thumbnailHeight,a.height<this.options.thumbnailHeight||a.width<this.options.thumbnailWidth?(b.trgHeight=b.srcHeight,b.trgWidth=b.srcWidth):c>d?(b.srcHeight=a.height,b.srcWidth=b.srcHeight*d):(b.srcWidth=a.width,b.srcHeight=b.srcWidth/d),b.srcX=(a.width-b.srcWidth)/2,b.srcY=(a.height-b.srcHeight)/2,b},drop:function(){return this.element.classList.remove("dz-drag-hover")},dragstart:g,dragend:function(){return this.element.classList.remove("dz-drag-hover")},dragenter:function(){return this.element.classList.add("dz-drag-hover")},dragover:function(){return this.element.classList.add("dz-drag-hover")},dragleave:function(){return this.element.classList.remove("dz-drag-hover")},selectedfiles:function(){return this.element===this.previewsContainer?this.element.classList.add("dz-started"):void 0},reset:function(){return this.element.classList.remove("dz-started")},addedfile:function(a){return a.previewElement=b.createElement(this.options.previewTemplate),a.previewTemplate=a.previewElement,this.previewsContainer.appendChild(a.previewElement),a.previewElement.querySelector("[data-dz-name]").textContent=a.name,a.previewElement.querySelector("[data-dz-size]").innerHTML=this.filesize(a.size)},removedfile:function(a){var b;return null!=(b=a.previewElement)?b.parentNode.removeChild(a.previewElement):void 0},thumbnail:function(a,b){var c;return a.previewElement.classList.remove("dz-file-preview"),a.previewElement.classList.add("dz-image-preview"),c=a.previewElement.querySelector("[data-dz-thumbnail]"),c.alt=a.name,c.src=b},error:function(a,b){return a.previewElement.classList.add("dz-error"),a.previewElement.querySelector("[data-dz-errormessage]").textContent=b},processingfile:function(a){return a.previewElement.classList.add("dz-processing")},uploadprogress:function(a,b){return a.previewElement.querySelector("[data-dz-uploadprogress]").style.width=""+b+"%"},totaluploadprogress:g,sending:g,success:function(a){return a.previewElement.classList.add("dz-success")},complete:g,previewTemplate:'<div class="dz-preview dz-file-preview">\n  <div class="dz-details">\n    <div class="dz-filename"><span data-dz-name></span></div>\n    <div class="dz-size" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n  <div class="dz-success-mark"><span>✔</span></div>\n  <div class="dz-error-mark"><span>✘</span></div>\n  <div class="dz-error-message"><span data-dz-errormessage></span></div>\n</div>'},c=function(){var a,b,c,d,e,f,g;for(d=arguments[0],c=2<=arguments.length?k.call(arguments,1):[],f=0,g=c.length;g>f;f++){b=c[f];for(a in b)e=b[a],d[a]=e}return d},b.prototype.init=function(){var a,c,d,e,f,g,h,i=this;for("form"===this.element.tagName&&this.element.setAttribute("enctype","multipart/form-data"),this.element.classList.contains("dropzone")&&!this.element.querySelector("[data-dz-message]")&&this.element.appendChild(b.createElement('<div class="dz-default dz-message" data-dz-message><span>'+this.options.dictDefaultMessage+"</span></div>")),this.clickableElements.length&&(d=function(){return i.hiddenFileInput&&document.body.removeChild(i.hiddenFileInput),i.hiddenFileInput=document.createElement("input"),i.hiddenFileInput.setAttribute("type","file"),i.hiddenFileInput.setAttribute("multiple","multiple"),null!=i.options.acceptedMimeTypes&&i.hiddenFileInput.setAttribute("accept",i.options.acceptedMimeTypes),null!=i.options.acceptParameter&&i.hiddenFileInput.setAttribute("accept",i.options.acceptParameter),i.hiddenFileInput.style.visibility="hidden",i.hiddenFileInput.style.position="absolute",i.hiddenFileInput.style.top="0",i.hiddenFileInput.style.left="0",i.hiddenFileInput.style.height="0",i.hiddenFileInput.style.width="0",document.body.appendChild(i.hiddenFileInput),i.hiddenFileInput.addEventListener("change",function(){var a;return a=i.hiddenFileInput.files,a.length&&(i.emit("selectedfiles",a),i.handleFiles(a)),d()})},d()),this.URL=null!=(g=window.URL)?g:window.webkitURL,h=this.events,e=0,f=h.length;f>e;e++)a=h[e],this.on(a,this.options[a]);return this.on("uploadprogress",function(a){var b,c,d,e,f,g;for(c=0,b=0,g=i.acceptedFiles,e=0,f=g.length;f>e;e++)a=g[e],c+=a.upload.bytesSent,b+=a.upload.total;return d=100*c/b,i.emit("totaluploadprogress",d,b,c)}),c=function(a){return a.stopPropagation(),a.preventDefault?a.preventDefault():a.returnValue=!1},this.listeners=[{element:this.element,events:{dragstart:function(a){return i.emit("dragstart",a)},dragenter:function(a){return c(a),i.emit("dragenter",a)},dragover:function(a){return c(a),i.emit("dragover",a)},dragleave:function(a){return i.emit("dragleave",a)},drop:function(a){return c(a),i.drop(a),i.emit("drop",a)},dragend:function(a){return i.emit("dragend",a)}}}],this.clickableElements.forEach(function(a){return i.listeners.push({element:a,events:{click:function(c){return a!==i.element||c.target===i.element||b.elementInside(c.target,i.element.querySelector(".dz-message"))?i.hiddenFileInput.click():void 0}}})}),this.enable(),this.options.init.call(this)},b.prototype.destroy=function(){var a;return this.disable(),this.removeAllFiles(),(null!=(a=this.hiddenFileInput)?a.parentNode:void 0)?(this.hiddenFileInput.parentNode.removeChild(this.hiddenFileInput),this.hiddenFileInput=null):void 0},b.prototype.getFallbackForm=function(){var a,c,d,e;return(a=this.getExistingFallback())?a:(d='<div class="dz-fallback">',this.options.dictFallbackText&&(d+="<p>"+this.options.dictFallbackText+"</p>"),d+='<input type="file" name="'+this.options.paramName+'[]" multiple="multiple" /><button type="submit">Upload!</button></div>',c=b.createElement(d),"FORM"!==this.element.tagName?(e=b.createElement('<form action="'+this.options.url+'" enctype="multipart/form-data" method="'+this.options.method+'"></form>'),e.appendChild(c)):(this.element.setAttribute("enctype","multipart/form-data"),this.element.setAttribute("method",this.options.method)),null!=e?e:c)},b.prototype.getExistingFallback=function(){var a,b,c,d,e,f;for(b=function(a){var b,c,d;for(c=0,d=a.length;d>c;c++)if(b=a[c],/(^| )fallback($| )/.test(b.className))return b},f=["div","form"],d=0,e=f.length;e>d;d++)if(c=f[d],a=b(this.element.getElementsByTagName(c)))return a},b.prototype.setupEventListeners=function(){var a,b,c,d,e,f,g;for(f=this.listeners,g=[],d=0,e=f.length;e>d;d++)a=f[d],g.push(function(){var d,e;d=a.events,e=[];for(b in d)c=d[b],e.push(a.element.addEventListener(b,c,!1));return e}());return g},b.prototype.removeEventListeners=function(){var a,b,c,d,e,f,g;for(f=this.listeners,g=[],d=0,e=f.length;e>d;d++)a=f[d],g.push(function(){var d,e;d=a.events,e=[];for(b in d)c=d[b],e.push(a.element.removeEventListener(b,c,!1));return e}());return g},b.prototype.disable=function(){var a,b,c,d,e,f,g,h;for(this.clickableElements.forEach(function(a){return a.classList.remove("dz-clickable")}),this.removeEventListeners(),f=this.filesProcessing,b=0,d=f.length;d>b;b++)a=f[b],this.cancelUpload(a);for(g=this.filesQueue,h=[],c=0,e=g.length;e>c;c++)a=g[c],h.push(this.cancelUpload(a));return h},b.prototype.enable=function(){return this.clickableElements.forEach(function(a){return a.classList.add("dz-clickable")}),this.setupEventListeners()},b.prototype.filesize=function(a){var b;return a>=1e11?(a/=1e11,b="TB"):a>=1e8?(a/=1e8,b="GB"):a>=1e5?(a/=1e5,b="MB"):a>=100?(a/=100,b="KB"):(a=10*a,b="b"),"<strong>"+Math.round(a)/10+"</strong> "+b},b.prototype.drop=function(a){var b;if(a.dataTransfer)return b=a.dataTransfer.files,this.emit("selectedfiles",b),b.length?this.handleFiles(b):void 0},b.prototype.handleFiles=function(a){var b,c,d,e;for(e=[],c=0,d=a.length;d>c;c++)b=a[c],e.push(this.addFile(b));return e},b.prototype.accept=function(a,c){return a.size>1024*1024*this.options.maxFilesize?c(this.options.dictFileTooBig.replace("{{filesize}}",Math.round(a.size/1024/10.24)/100).replace("{{maxFilesize}}",this.options.maxFilesize)):b.isValidMimeType(a.type,this.options.acceptedMimeTypes)?this.options.accept.call(this,a,c):c(this.options.dictInvalidFileType)},b.prototype.addFile=function(a){var c=this;return a.upload={progress:0,total:a.size,bytesSent:0},this.files.push(a),a.status=b.ADDED,this.emit("addedfile",a),this.options.createImageThumbnails&&a.type.match(/image.*/)&&a.size<=1024*1024*this.options.maxThumbnailFilesize&&this.createThumbnail(a),this.accept(a,function(d){return d?(a.accepted=!1,c.errorProcessing(a,d)):(a.status=b.ACCEPTED,a.accepted=!0,c.acceptedFiles.push(a),c.options.enqueueForUpload?(c.filesQueue.push(a),c.processQueue()):void 0)})},b.prototype.removeFile=function(a){return a.status===b.UPLOADING&&this.cancelUpload(a),this.files=h(this.files,a),this.filesQueue=h(this.filesQueue,a),this.emit("removedfile",a),0===this.files.length?this.emit("reset"):void 0},b.prototype.removeAllFiles=function(){var a,b,c,d;for(d=this.files.slice(),b=0,c=d.length;c>b;b++)a=d[b],l.call(this.filesProcessing,a)<0&&this.removeFile(a);return null},b.prototype.createThumbnail=function(a){var b,c=this;return b=new FileReader,b.onload=function(){var d;return d=new Image,d.onload=function(){var b,e,f,g,h,i,j,k;return a.width=d.width,a.height=d.height,f=c.options.resize.call(c,a),null==f.trgWidth&&(f.trgWidth=c.options.thumbnailWidth),null==f.trgHeight&&(f.trgHeight=c.options.thumbnailHeight),b=document.createElement("canvas"),e=b.getContext("2d"),b.width=f.trgWidth,b.height=f.trgHeight,e.drawImage(d,null!=(h=f.srcX)?h:0,null!=(i=f.srcY)?i:0,f.srcWidth,f.srcHeight,null!=(j=f.trgX)?j:0,null!=(k=f.trgY)?k:0,f.trgWidth,f.trgHeight),g=b.toDataURL("image/png"),c.emit("thumbnail",a,g)},d.src=b.result},b.readAsDataURL(a)},b.prototype.processQueue=function(){var a,b,c;for(b=this.options.parallelUploads,c=this.filesProcessing.length,a=c;b>a;){if(!this.filesQueue.length)return;this.processFile(this.filesQueue.shift()),a++}},b.prototype.processFile=function(a){return this.filesProcessing.push(a),a.processing=!0,a.status=b.UPLOADING,this.emit("processingfile",a),this.uploadFile(a)},b.prototype.cancelUpload=function(a){var c;return a.status===b.UPLOADING?(a.status=b.CANCELED,a.xhr.abort(),this.filesProcessing=h(this.filesProcessing,a)):(c=a.status)===b.ADDED||c===b.ACCEPTED?(a.status=b.CANCELED,this.filesQueue=h(this.filesQueue,a)):void 0},b.prototype.uploadFile=function(a){var d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w=this;q=new XMLHttpRequest,a.xhr=q,q.withCredentials=!!this.options.withCredentials,q.open(this.options.method,this.options.url,!0),n=null,e=function(){return w.errorProcessing(a,n||w.options.dictResponseError.replace("{{statusCode}}",q.status),q)},o=function(b){var c;if(null!=b)c=100*b.loaded/b.total,a.upload={progress:c,total:b.total,bytesSent:b.loaded};else{if(100===a.upload.progress&&a.upload.bytesSent===a.upload.total)return;c=100,a.upload.progress=c,a.upload.bytesSent=a.upload.total}return w.emit("uploadprogress",a,c,a.upload.bytesSent)},q.onload=function(c){var d;if(a.status!==b.CANCELED&&4===q.readyState){if(n=q.responseText,q.getResponseHeader("content-type")&&~q.getResponseHeader("content-type").indexOf("application/json"))try{n=JSON.parse(n)}catch(f){c=f,n="Invalid JSON response from server."}return o(),200<=(d=q.status)&&300>d?w.finished(a,n,c):e()}},q.onerror=function(){return a.status!==b.CANCELED?e():void 0},m=null!=(t=q.upload)?t:q,m.onprogress=o,g={Accept:"application/json","Cache-Control":"no-cache","X-Requested-With":"XMLHttpRequest","X-File-Name":encodeURIComponent(a.name)},this.options.headers&&c(g,this.options.headers);for(f in g)l=g[f],q.setRequestHeader(f,l);if(d=new FormData,this.options.params){u=this.options.params;for(k in u)p=u[k],d.append(k,p)}if("FORM"===this.element.tagName)for(v=this.element.querySelectorAll("input, textarea, select, button"),r=0,s=v.length;s>r;r++)h=v[r],i=h.getAttribute("name"),j=h.getAttribute("type"),(!j||"checkbox"!==j.toLowerCase()||h.checked)&&d.append(i,h.value);return this.emit("sending",a,q,d),d.append(this.options.paramName,a),q.send(d)},b.prototype.finished=function(a,c,d){return this.filesProcessing=h(this.filesProcessing,a),a.processing=!1,a.status=b.SUCCESS,this.processQueue(),this.emit("success",a,c,d),this.emit("finished",a,c,d),this.emit("complete",a)},b.prototype.errorProcessing=function(a,c,d){return this.filesProcessing=h(this.filesProcessing,a),a.processing=!1,a.status=b.ERROR,this.processQueue(),this.emit("error",a,c,d),this.emit("complete",a)},b}(d),a.version="3.4.1",a.options={},a.optionsForElement=function(b){return b.id?a.options[e(b.id)]:void 0},a.instances=[],a.forElement=function(a){if("string"==typeof a&&(a=document.querySelector(a)),null==(null!=a?a.dropzone:void 0))throw new Error("No Dropzone found for given element. This is probably because you're trying to access it before Dropzone had the time to initialize. Use the `init` option to setup any additional observers on your Dropzone.");return a.dropzone},a.autoDiscover=!0,a.discover=function(){var b,c,d,e,f,g;if(a.autoDiscover){for(document.querySelectorAll?d=document.querySelectorAll(".dropzone"):(d=[],b=function(a){var b,c,e,f;for(f=[],c=0,e=a.length;e>c;c++)b=a[c],/(^| )dropzone($| )/.test(b.className)?f.push(d.push(b)):f.push(void 0);return f},b(document.getElementsByTagName("div")),b(document.getElementsByTagName("form"))),g=[],e=0,f=d.length;f>e;e++)c=d[e],a.optionsForElement(c)!==!1?g.push(new a(c)):g.push(void 0);return g}},a.blacklistedBrowsers=[/opera.*Macintosh.*version\/12/i],a.isBrowserSupported=function(){var b,c,d,e,f;if(b=!0,window.File&&window.FileReader&&window.FileList&&window.Blob&&window.FormData&&document.querySelector)if("classList"in document.createElement("a"))for(f=a.blacklistedBrowsers,d=0,e=f.length;e>d;d++)c=f[d],c.test(navigator.userAgent)&&(b=!1);else b=!1;else b=!1;return b},h=function(a,b){var c,d,e,f;for(f=[],d=0,e=a.length;e>d;d++)c=a[d],c!==b&&f.push(c);return f},e=function(a){return a.replace(/[\-_](\w)/g,function(a){return a[1].toUpperCase()})},a.createElement=function(a){var b;return b=document.createElement("div"),b.innerHTML=a,b.childNodes[0]},a.elementInside=function(a,b){if(a===b)return!0;for(;a=a.parentNode;)if(a===b)return!0;return!1},a.getElement=function(a,b){var c;if("string"==typeof a?c=document.querySelector(a):null!=a.nodeType&&(c=a),null==c)throw new Error("Invalid `"+b+"` option provided. Please provide a CSS selector or a plain HTML element.");return c},a.getElements=function(a,b){var c,d,e,f,g,h,i,j;if(a instanceof Array){e=[];try{for(f=0,h=a.length;h>f;f++)d=a[f],e.push(this.getElement(d,b))}catch(k){c=k,e=null}}else if("string"==typeof a)for(e=[],j=document.querySelectorAll(a),g=0,i=j.length;i>g;g++)d=j[g],e.push(d);else null!=a.nodeType&&(e=[a]);if(null==e||!e.length)throw new Error("Invalid `"+b+"` option provided. Please provide a CSS selector, a plain HTML element or a list of those.");return e},a.isValidMimeType=function(a,b){var c,d,e,f;if(!b)return!0;for(b=b.split(","),c=a.replace(/\/.*$/,""),e=0,f=b.length;f>e;e++)if(d=b[e],d=d.trim(),/\/\*$/.test(d)){if(c===d.replace(/\/.*$/,""))return!0}else if(a===d)return!0;return!1},"undefined"!=typeof jQuery&&null!==jQuery&&(jQuery.fn.dropzone=function(b){return this.each(function(){return new a(this,b)})}),"undefined"!=typeof c&&null!==c?c.exports=a:window.Dropzone=a,a.ADDED="added",a.ACCEPTED="accepted",a.UPLOADING="uploading",a.CANCELED="canceled",a.ERROR="error",a.SUCCESS="success",f=function(a,b){var c,d,e,f,g,h,i,j,k;if(e=!1,k=!0,d=a.document,j=d.documentElement,c=d.addEventListener?"addEventListener":"attachEvent",i=d.addEventListener?"removeEventListener":"detachEvent",h=d.addEventListener?"":"on",f=function(c){return"readystatechange"!==c.type||"complete"===d.readyState?(("load"===c.type?a:d)[i](h+c.type,f,!1),!e&&(e=!0)?b.call(a,c.type||c):void 0):void 0},g=function(){var a;try{j.doScroll("left")}catch(b){return a=b,setTimeout(g,50),void 0}return f("poll")},"complete"!==d.readyState){if(d.createEventObject&&j.doScroll){try{k=!a.frameElement}catch(l){}k&&g()}return d[c](h+"DOMContentLoaded",f,!1),d[c](h+"readystatechange",f,!1),a[c](h+"load",f,!1)}},f(window,a.discover)}.call(this)}),a.alias("component-emitter/index.js","dropzone/deps/emitter/index.js"),a.alias("component-emitter/index.js","emitter/index.js"),"object"==typeof exports?module.exports=a("dropzone"):"function"==typeof define&&define.amd?define(function(){return a("dropzone")}):this.Dropzone=a("dropzone")}();