<?php
namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Session;
use File;
use App\Models\CsProduct;
use App\Models\CsCategory;
use Illuminate\Support\Str;



class ProductController extends Controller
{
    public function index()
    {
        $title = "Product";
        $productData = CsProduct::orderBy('product_id', 'ASC')->get();
        return view('csadmin.product.index', compact('title', 'productData'));

    }

    public function addproduct($id = null)
    {
        $title = "Add Product";
        $productIdData = array();
        if (isset($id) && $id > 0) {
            $productIdData = CsProduct::where('product_id', $id)->first();
        }
        $categoryData=CsCategory::orderBy('cat_id','ASC')->get();
        return view('csadmin.product.addproduct', compact('title', 'productIdData','categoryData'));

    }
    public function addproductprocess(Request $request)
    {
          $requestData = $request->all();
        if ($request->product_id && $request->product_id > 0) {
            $productObj = CsProduct::where('product_id', $request->product_id)->first();
            $request->validate([
                'product_name' => 'required',
                'product_sku' => 'required',
                'product_meta_title' => 'required',
            ]);
        } else {
            $request->validate([
                'product_name' => 'required',
                'product_sku' => 'required',
                'product_meta_title' => 'required',
            ]);
            $productObj = new CsProduct;
        }
        if(isset($request->category_id) && $request->category_id != '')
        {
             $categoryImp = implode(',',$requestData['category_id']);
            $categoryNames=CsCategory::whereIn('cat_id',$requestData['category_id'])->pluck('cat_name')->toArray();
            $categoryNames=implode(',',$categoryNames);
            
        }else{
            return redirect()->back()->with('error','Please Select Category');
        }

        

        $productObj['product_name'] = $request->product_name;
        $productObj['product_uniqueid'] = $request->product_sku;
        $productObj['product_sku'] = $request->product_sku;
        $productObj['product_category_id'] = $categoryImp;
        $productObj['product_category_name'] = $categoryNames;
        $productObj['product_description'] = $request->product_description;
        $productObj['product_price'] = $request->product_price;
        $productObj['product_selling_price'] = $request->product_selling_price;
        $productObj['product_discount'] = $request->product_discount;
        $productObj['product_moq'] = $request->product_moq;
        $productObj['product_meta_title'] = $request->product_meta_title;
        $productObj['product_meta_keyword'] = $request->product_meta_keyword;
        $productObj['product_slug'] = $this->generateSlug($request->product_name);

        if ($request->hasFile('product_image')) {
            $destination_path = public_path(env('SITE_UPLOAD_PATH') . "product/" . $productObj->product_image);
            if (File::delete($destination_path)) {
                $productObj->product_image = '';
            }
            $image = $request->file('product_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "product");
            $image->move($destinationPath, $name);
            $productObj->product_image = $name;
        }

        if ($productObj->save()) {
            if ($request->product_id && $request->product_id > 0) {

                return redirect()->route('csadmin.product.index')->with('success', 'Product Update Successfully');
            } else {
                return redirect()->route('csadmin.product.index')->with('success', 'Product Add Successfully');

            }
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');

        }


    }
    public function deleteproduct($id = 0)
    {
        $productIdData = CsProduct::where('product_id', $id)->first();
        if ($productIdData->delete()) {
            if (isset($productIdData['product_id']) && $productIdData['product_id'] > 0) {
                if (isset($productIdData->product_image) && $productIdData->product_image != '') {
                    $productIdData = public_path(env('SITE_UPLOAD_PATH') . "product/" . $productIdData->product_image);
                    File::delete($productIdData);
                }
            }
            return redirect()->back()->with('success', 'Product Deleted Successfully');
        }
    }
    public function productstatus($id = 0)
    {
        $productIdData = CsProduct::where('product_id', $id)->first();
        if ($productIdData->product_status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        $statusupdate = CsProduct::where('product_id', $id)->update(['product_status' => $status]);
        return redirect()->back()->with('success', 'Status Update Success');
    }
    public function addproductcheckslug(Request $request)
    {
        // return $request;
        $slug = str::slug($request->title);
        $metatitle = $request->title;
        return response()->json(['slug' => $slug, 'metatitle' => $metatitle]);
    }

    public function checkfeatured($id=null,$status=null)
    {
        $productObj = CsProduct::where('product_id',$id)->first();
        if($productObj->product_featured == 0)
        {
            $productObj->product_featured = 1;
        } else{
            $productObj->product_featured = 0;
        }
        if ($productObj->save())
        {
            return redirect()->back()->with('success', 'Product Featured Updated Successfully');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    public function generateSlug($slug = '')
    {
        return $slug = str::slug($slug);
    }



    //Product category
    public function category($id=null)
    {
        $title = "Category";
        $categoryIdData = array();
        if (isset($id) && $id > 0) {
            $categoryIdData = CsCategory::where('cat_id', $id)->first();
        }
        $categoryData=CsCategory::orderBy('cat_id','ASC')->get();
        return view('csadmin.product.category', compact('title', 'categoryIdData','categoryData'));
    }

    public function addcategoryprocess(Request $request)
    {
        if ($request->isMethod('post')) {
            $requestData = $request->all();

            if (isset($requestData['cat_id']) && $requestData['cat_id'] > 0) {
                $categoryObj = CsCategory::where('cat_id', $requestData['cat_id'])->first();
                $categoryExsits=CsCategory::where('cat_name','!=', $categoryObj->cat_name)->where('cat_name',$request->cat_name)->first();
                if($categoryExsits)
                {
                    return redirect()->back()->with('error','Category Already Exists');
                }
                $request->validate([
                    'cat_slug' => 'required',
                ]);
            } else {
                $request->validate([
                    'cat_name' => 'required|unique:cs_category',
                    'cat_slug' => 'required',
                ]);
                $categoryObj = new CsCategory;
            }
            $categoryObj->cat_name = $requestData['cat_name'];
            $categoryObj->cat_slug = $requestData['cat_slug'];

            if ($categoryObj->save()) {
                if (isset($requestData['cat_id']) && $requestData['cat_id'] > 0) {
                    return redirect()->route('csadmin.product.category')->with('success', 'Category Updated Successfully');
                } else {
                    return redirect()->back()->with('success', 'Category Added Successfully');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Method');
        }
    }

    public function categorystatus($id)
    {
        // return $id;
        $categoryData = CsCategory::where('cat_id', $id)->first();
        if ($categoryData->cat_status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        $statusupdate = CsCategory::where('cat_id', $id)->update(['cat_status' => $status]);
        return redirect()->back()->with('success', 'Status Update Success');
    }
    public function deletecategory($id)
    {
        // return $id;
        $categoryData = CsCategory::where('cat_id', $id)->first();
        if ($categoryData->delete()) {
            return redirect()->back()->with('success', 'Menu Delete Successfully');
        }

    }

}