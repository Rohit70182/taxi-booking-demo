<?php

namespace Modules\Catalog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Catalog\Entities\CatalogCategory;

use Illuminate\Support\Facades\Redirect;
use Modules\Catalog\Entities\CatalogSubCategory;

class CatalogController extends Controller
{
    /*
     * Catalog category add, view, edit, delete
    */

    public function catalogCategory()
    {
        $category = CatalogCategory::where('state_id', CatalogCategory::STATE_ACTIVE)->paginate(8);
        return view('dashboard.catalog-category.catalogcategory', compact('category'));
    }

    public function addCatalogCategory()
    {
        return view('dashboard.catalog-category.add-catalogcategory');
    }

    public function createCatalogCategory(Request $request)
    {
        try {

            $validator = validator(
                $request->all(),
                [
                    'title' => 'required',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $category = new CatalogCategory();
            $category->title = $request->title;
            $category->state_id = CatalogCategory::STATE_ACTIVE;
            $category->created_by_id = Auth::user()->id;
            $category->save();

            if ($category) {
                return redirect('/catalog/category')->with('success', "Category saved successfully");
            } else {
                return
                    redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function showCatalogCategory($id)
    {
        $show_category = CatalogCategory::where('id', $id)->first();
        return view('dashboard.catalog-category.show-catalogcategory', compact('show_category'));
    }

    public function deleteCatalogCategory($id)
    {
        try {
            $category = CatalogCategory::where('id', $id)->first();
            if (!empty($category)) {
                $category->delete();
                return redirect('/catalog/category')->with('success', "Category Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Category not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editCatalogCategory($id)
    {
        $GetData = CatalogCategory::find($id);
        return view('dashboard.catalog-category.update-catalogcategory', compact('GetData'));
    }

    public function updateCatalogCategory(Request $request, $id)
    {
        try {
            $category = CatalogCategory::find($id);
            $category->title = $request->title;

            if ($category->update()) {
                return redirect('/catalog/category')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /*
     * Catalog subcategory add, view, edit, delete
    */

    public function catalogSubCategory()
    {
        $sub_category = CatalogSubCategory::where('state_id', CatalogSubCategory::STATE_ACTIVE)->paginate(8);
        return view('dashboard.catalog-subcategory.catalogsubcategory', compact('sub_category'));
    }

    public function addCatalogSubCategory()
    {
        $categories = CatalogCategory::get();
        return view('dashboard.catalog-subcategory.add-catalogsubcategory', compact('categories'));
    }

    public function createCatalogSubCategory(Request $request)
    {

        try {

            $validator = validator(
                $request->all(),
                [
                    'category_id' => 'required',
                    'title' => 'required',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $subcategory = new CatalogSubCategory();
            $subcategory->title = $request->title;
            $subcategory->category_id = $request->category_id;
            $subcategory->state_id = CatalogSubCategory::STATE_ACTIVE;
            $subcategory->created_by_id = Auth::user()->id;
            $subcategory->save();

            if ($subcategory) {
                return redirect('/catalog/subcategory')->with('success', "Subcategory saved successfully");
            } else {
                return
                    redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function showCatalogSubCategory($id)
    {
        $show_subcategory = CatalogSubCategory::where('id', $id)->first();
        return view('dashboard.catalog-subcategory.show-catalogsubcategory', compact('show_subcategory'));
    }

    public function deleteCatalogSubCategory($id)
    {
        try {
            $category = CatalogSubCategory::where('id', $id)->first();
            if (!empty($category)) {
                $category->delete();
                return redirect('/catalog/subcategory')->with('success', "SubCategory Deleted successfully");
            } else {
                return redirect()->back()->with('error', "Category not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editCatalogSubCategory($id)
    {
        $GetData = CatalogSubCategory::find($id);
        $category = CatalogCategory::where('id', $GetData->category_id)->first();
        $all_category = CatalogCategory::get();
        return view('dashboard.catalog-subcategory.update-catalogsubcategory', compact('category', 'all_category'));
    }

    public function updateCatalogSubCategory(Request $request, $id)
    {
        try {
            $category = CatalogSubCategory::find($id);
            $category->title = $request->title;
            if ($category->update()) {
                return redirect('/catalog/subcategory')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
