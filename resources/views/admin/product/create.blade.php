@extends('admin.layouts.app')

@section('title','Create Product')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Filepond css -->
     <!-- Plugins css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
     <style>
        p {
  margin: 0;
}

.upload__box {
    text-align: center;
}
.upload__inputfile {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.upload__btn {
  display: inline-block;
  font-weight: 600;
  color: #fff;
  text-align: center;
  min-width: 116px;
  padding: 5px;
  transition: all 0.3s ease;
  cursor: pointer;
  border: 2px solid;
  background-color: #4045ba;
  border-color: #4045ba;
  border-radius: 10px;
  line-height: 26px;
  font-size: 14px;
}
.upload__btn:hover {
  background-color: unset;
  color: #4045ba;
  transition: all 0.3s ease;
}
.upload__btn-box {
  margin-bottom: 10px;
}
.upload__img-wrap {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -10px;
}
.upload__img-box {
  width: 200px;
  padding: 0 10px;
  margin-bottom: 12px;
}
.upload__img-close {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: rgba(0, 0, 0, 0.5);
  position: absolute;
  top: 10px;
  right: 10px;
  text-align: center;
  line-height: 24px;
  z-index: 1;
  cursor: pointer;
}
.upload__img-close:after {
  content: "✖";
  font-size: 14px;
  color: white;
}

.img-bg {
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  position: relative;
  padding-bottom: 100%;
}
     </style>
@endpush
@section('content')
        <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Create Product</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Create Product</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Product Name</label>
                                            <input type="text" class="form-control" name="name" value="">
                                        
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Product Price</label>
                                            <input type="number" class="form-control"  name="unit_price" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Purchase Price</label>
                                            <input type="number" class="form-control"  name="purchase_price" value="">
                                        </div>
                                        <div>
                                            <label>Product Description</label>
                                            <div >
                                                <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Current Stock</label>
                                            <input type="number" class="form-control"  name="current_stock" value="1">
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Product Gallery</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="fs-14 mb-1">Product Thumbnail</h5>
                                            <p class="text-muted">Add Product main Image.</p>
                                            <div class="text-center">
                                               <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                   <img src="{{asset('backend/assets/images/demo/def.jpg')}}"  class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                                   <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                       <input id="profile-img-file-input" name="thumbnail" type="file" class="profile-img-file-input">
                                                       <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                           <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                               <i class="ri-camera-fill"></i>
                                                           </span>
                                                       </label>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="fs-14 mb-1">Product Gallery</h5>
                                            <p class="text-muted">Add Product Gallery Images.</p>
          
                                            <div class="mb-3">
                                              <div class="upload__box">
                                                 <div class="upload__btn-box">
                                                   <label class="upload__btn">
                                                     <p>Upload images</p>
                                                     <input type="file" name="images[]" multiple="" data-max_length="20" class="upload__inputfile">
                                                   </label>
                                                 </div>
                                                 <div class="upload__img-wrap"></div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                            <!-- <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">
                                                    General Info
                                                </a>
                                            </li> -->
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab">
                                                    Meta Data
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end card header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            

                                            <div class="tab-pane active" id="addproduct-metadata" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="meta-title-input">Meta title</label>
                                                            <input type="text" class="form-control" name="meta_title" placeholder="Enter meta title">
                                                        </div>
                                                    </div>
                                                    <!-- end col -->

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                                            <input type="text" class="form-control" name="meta_image" placeholder="Enter meta keywords">
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div>
                                                <!-- end row -->

                                                <div>
                                                    <label class="form-label" for="meta-description-input">Meta Description</label>
                                                    <textarea class="form-control"  name="meta_description" placeholder="Enter meta description" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                                
                            </div>
                            <!-- end col -->

                            <div class="col-lg-4">
                                  <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Product Categories</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted mb-2"> 
                                            <a href="{{route('category.list')}}" class="float-end text-decoration-underline">
                                                Add New
                                            </a>
                                            Select product category
                                        </p>
                                        <select class="form-select" name="category_id">
                                               @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                  </div>
                                <!-- end card -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Discount</h5>
                                    </div>
                                    <div class="card-body">
                                    <div class="mb-3">
                                            <label for="choices-publish-status-input" class="form-label">Select Discount Type</label>
                                            <select class="form-select"  name="discount_type" >
                                                <option value="flat">Flat</option>
                                                <option value="percent">Percent</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Discount</label>
                                            <input type="number" class="form-control"  name="discount" value="0">
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->   

                            </div>
                            <!-- end col -->
                            <div class="text-end mb-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                        </div>
                        <!-- end row -->

                    </form>

                </div>
                <!-- container-fluid -->
            </div>
    
@endsection
@push('script')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script>
    jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
  });
}
</script>

@endpush
