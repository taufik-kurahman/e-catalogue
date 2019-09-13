<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProducts extends CI_Model {

  public function getNewID() {
    $this->db->limit(1);
    $this->db->order_by('id_product', 'DESC');
    $this->db->select('id_product');
    $this->db->from('products');

    $query = $this->db->get();
    $row = $query->row_array();

    if ($query->num_rows() > 0) {
      $lastID = $row['id_product'];
      $newID = $lastID + 1;
    }else {
      $newID = 1;
    }
    return $newID;
  }

  public function getRowsCount() {
    return $this->db->get('products')->num_rows();
  }

  public function getFilteredRowsCount($search = null, $categories = null) {
    if ($search == null && $categories == null) {
      return $this->db->get('products')->num_rows();
    } else {
      if ($search == null && $categories != null) {
        $query = "SELECT * FROM products WHERE id_category = ".$categories[0];
        if (count($categories) > 1) {
          for ($i=1, $l = count($categories); $i < $l; $i++) { 
            $query .= " OR id_category = ".$categories[$i];
          }
        }
      } elseif ($categories == null && $search != null) {
        $query = "SELECT * FROM products WHERE product_name LIKE '".$search."%' OR product_desc LIKE '".$search."%'";
      } elseif ($categories != null && $search != null) {
        $query = "SELECT * FROM products WHERE product_name LIKE '".$search."%' AND id_category = ".$categories[0]." OR product_desc LIKE '".$search."%' AND id_category = ".$categories[0];
        if (count($categories) > 1) {
          for ($i=1, $l = count($categories); $i < $l; $i++) { 
            $query .= " OR product_name LIKE '".$search."%' AND id_category = ".$categories[$i]." OR product_desc LIKE '".$search."%' AND id_category = ".$categories[$i];
          }
        }
      }
      return $this->db->query($query)->num_rows();
    }
  }

  public function getProducts($limit, $start) {
    $output = '';
    $this->db->order_by('id_category', 'ASC');
    $query = $this->db->get('products', $limit, $start);
    foreach ($query->result_array() as $row) {
      $output .='
        <div class="col-lg-4 col-sm-4 products-card-container pb-2">
          <div class="card">
            <div class="text-center">
              <img src="'.base_url('assets/images/products/').$row['product_pict'].'" class="img img-fluid">
            </div>
            <hr>
            <div class="p-2">
      ';
            if (strlen($row['product_name'])>60) {
              $output .='
              <h5 class="product-highlight-links">'.substr($row['product_name'], 0, 57).'...</h5>';
              if ($row['product_discount'] > 0) {
                $final_price = intval($row['product_price']) - ((intval($row['product_discount']) / 100) * intval($row['product_price']));
                $output .='
                <small><i class="fas fa-tag"></i> IDR <del class="text-danger">'.$row['product_price'].'</del> '.$final_price.'</small></div>';
              } else {
                $output .='
                <small><i class="fas fa-tag"></i> IDR '.$row['product_price'].'</small></div>';
              }
            }else{
              $output .='
              <h5 class="product-highlight-links">'.$row['product_name'].'</h5>';
              if ($row['product_discount'] > 0) {
                $final_price = intval($row['product_price']) - ((intval($row['product_discount']) / 100) * intval($row['product_price']));
                $output .='
                <small><i class="fas fa-tag"></i> IDR <del class="text-danger">'.$row['product_price'].'</del> '.$final_price.'</small></div>';
              } else {
                $output .='
                <small><i class="fas fa-tag"></i> IDR '.$row['product_price'].'</small></div>';
              }
              if (strlen($row['product_name'])<=37) {
                $output .= '<br>';
              }
            }
          $output .='
            <div class="container-fluid p-2">
              <button class="btn btn-sm btn-outline-danger btn-detail" data-id="'.$row['id_product'].'">Detail <i class="far fa-eye"></i></button>
            </div>
          </div>
        </div>
      ';
    }
    return $output;
  }

  public function getFilteredProducts($limit, $start, $search = null, $categories = null) {
    $output = '';
    if ($search == null && $categories == null) {
      $sql = "SELECT * FROM products";
    } else {
      if ($search == null && $categories != null) {
        $sql = "SELECT * FROM products WHERE id_category = ".$categories[0];
        if (count($categories) > 1) {
          for ($i=1, $l = count($categories); $i < $l; $i++) { 
            $sql .= " OR id_category = ".$categories[$i];
          }
        }
      } elseif ($categories == null && $search != null) {
        $sql = "SELECT * FROM products WHERE product_name LIKE '".$search."%' OR product_desc LIKE '".$search."%'";
      } elseif ($categories != null && $search != null) {
        $sql = "SELECT * FROM products WHERE product_name LIKE '".$search."%' AND id_category = ".$categories[0]." OR product_desc LIKE '".$search."%' AND id_category = ".$categories[0];
        if (count($categories) > 1) {
          for ($i=1, $l = count($categories); $i < $l; $i++) { 
            $sql .= " OR product_name LIKE '".$search."%' AND id_category = ".$categories[$i]." OR product_desc LIKE '".$search."%' AND id_category = ".$categories[$i];
          }
        }
      }
      $sql .= " ORDER BY id_category ASC LIMIT ".$start.",".$limit;
    }
    $query = $this->db->query($sql);
    foreach ($query->result_array() as $row) {
      $output .='
        <div class="col-lg-4 col-sm-4 products-card-container pb-2">
          <div class="card">
            <div class="text-center">
              <img src="'.base_url('assets/images/products/').$row['product_pict'].'" class="img img-fluid">
            </div>
            <hr>
            <div class="p-2">
      ';
            if (strlen($row['product_name'])>60) {
              $output .='
              <h5 class="product-highlight-links">'.substr($row['product_name'], 0, 57).'...</h5>';
              if ($row['product_discount'] > 0) {
                $final_price = intval($row['product_price']) - ((intval($row['product_discount']) / 100) * intval($row['product_price']));
                $output .='
                <small><i class="fas fa-tag"></i> IDR <del class="text-danger">'.$row['product_price'].'</del> '.$final_price.'</small></div>';
              } else {
                $output .='
                <small><i class="fas fa-tag"></i> IDR '.$row['product_price'].'</small></div>';
              }
            }else{
              $output .='
              <h5 class="product-highlight-links">'.$row['product_name'].'</h5>';
              if ($row['product_discount'] > 0) {
                $final_price = intval($row['product_price']) - ((intval($row['product_discount']) / 100) * intval($row['product_price']));
                $output .='
                <small><i class="fas fa-tag"></i> IDR <del class="text-danger">'.$row['product_price'].'</del> '.$final_price.'</small></div>';
              } else {
                $output .='
                <small><i class="fas fa-tag"></i> IDR '.$row['product_price'].'</small></div>';
              }
              if (strlen($row['product_name'])<=37) {
                $output .= '<br>';
              }
            }
          $output .='
            <div class="container-fluid p-2">
              <button class="btn btn-sm btn-outline-danger btn-detail" data-id="'.$row['id_product'].'">Detail <i class="far fa-eye"></i></button>
            </div>
          </div>
        </div>
      ';
    }
    return $output;
  }

  public function getCategories() {
    return $this->db->get('categories')->result_array();
  }

  public function getProductDetail($id_product) {
    $product = $this->db->get_where('products', ['id_product' => $id_product])->row();
    if ($product->product_discount > 0) {
      $price = intval($product->product_price) - ((intval($product->product_discount) / 100) * intval($product->product_price));
      $final_price = '<del class="text-danger">'.$product->product_price.'</del> '.$price.' <span class="badge badge-success">'.$product->product_discount.'%</span>';
    } else {
      $final_price = $product->product_price;
    }
    if ($product->available == 1) {
      $available = '<span class="badge badge-success">In stock</span>';
    } else {
      $available = '<span class="badge badge-danger">Out of stock</span>';
    }
    $result = '
    <div class="row">
      <div class="col-md-6">
        <div class="container-fluid text-center">
          <img id="product-pict" src="'.base_url('assets/images/products/').$product->product_pict.'" class="img-fluid">
        </div>
      </div>
      <div class="col-md-6">
        <h5 class="product-highlight-links">'.$product->product_name.'</h5>
        <i class="fas fa-tag"></i> IDR '.$final_price.'
        <br>
        <i class="fas fa-check-circle"></i> '.$available.'
        <br>
        <i class="fas fa-info-circle"></i> Description :
        <br>
        '.$product->product_desc.'
      </div>
    </div>
    ';
    return $result;
  }

  public function getProductDetailForEdit($id_product) {
    $product = $this->db->get_where('products', ['id_product' => $id_product])->row();

    $categories = $this->getCategories();
    $option_category = '';
    foreach ($categories as $category) {
      if ($product->id_category == $category['id_category']) {
        $option_category .= '<option value="'.$category['id_category'].'" selected>'.$category['category_name'].'</option>';
      } else {
        $option_category .= '<option value="'.$category['id_category'].'">'.$category['category_name'].'</option>';
      }
    }

    if ($product->available == 1) {
      $option_available = '<option value="1" selected>Yes</option>
      <option value="2">No</option>';
    } else {
      $option_available = '<option value="1">Yes</option>
      <option value="2" selected>No</option>';
    }
    $result = '
    <div class="row">
      <div class="col-md-6">
        <div class="container-fluid text-center">
          <img id="product-pict" src="'.base_url('assets/images/products/').$product->product_pict.'" class="img-fluid">
        </div>
      </div>
      <div class="col-md-6">
        <form id="form-edit" enctype="multipart/form-data">
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control form-control-sm" id="category" name="id_category">
              '.$option_category.'
            </select>
          </div>
          <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control form-control-sm" value="'.$product->product_name.'">
            <input type="hidden" name="id_product" value="'.$id_product.'">
          </div>
          <div class="form-group">
            <label for="product_price">Product Price</label>
            <input type="number" name="product_price" id="product_price" class="form-control form-control-sm" value="'.$product->product_price.'">
          </div>
          <div class="form-group">
            <label for="product_desc">Product Description</label>
            <textarea class="form-control" name="product_desc" id="product_desc" rows="3">'.$product->product_desc.'</textarea>
          </div>
          <div class="form-group">
            <label for="product_discount">Product Discount</label>
            <input type="number" name="product_discount" id="product_discount" class="form-control form-control-sm" value="'.$product->product_discount.'">
          </div>
          <div class="form-group">
            <label for="available">Available</label>
            <select class="form-control form-control-sm" id="available" name="available">
              '.$option_available.'
            </select>
          </div>
          <div class="form-group">
            <input type="file" class="form-control-file" name="product_pict">
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-sm btn-outline-danger">Confirm <i class="far fa-check-circle"></i></button>
          </div>
        </form>
      </div>
    </div>
    ';
    return $result;
  }

  public function getCategory($id_category) {
    return $this->db->get_where('categories', ['id_category' => $id_category])->row();
  }

  private function getProductsByAdminQuery() {
    $this->db->select(array("products.*"));
    $this->db->from('products');
  }

  public function getProductsByAdmin() {

    $this->getProductsByAdminQuery();

    $order_column = array(null, "product_name", "product_price", "available", null);

    if(isset($_POST["order"])){
      $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }else {
      $this->db->order_by('id_category', 'ASC');
    }

    if($_POST["length"] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }

    if(isset($_POST["search"]["value"]))
    {
      $this->db->like("product_name", $_POST["search"]["value"]);
      $this->db->or_like("product_desc", $_POST["search"]["value"]);
      $this->db->or_like("product_price", $_POST["search"]["value"]);
    }

    $query = $this->db->get();
    return $query->result();
  }

  public function getProductsByAdminFilteredData() {
    $this->getProductsByAdminQuery();

    if(isset($_POST["search"]["value"]))
    {
      $this->db->like("product_name", $_POST["search"]["value"]);
      $this->db->or_like("product_desc", $_POST["search"]["value"]);
      $this->db->or_like("product_price", $_POST["search"]["value"]);
    }

    $query = $this->db->get();
    return $query->num_rows();
  }

  public function getProductsByAdminNumRows() {
    $this->getProductsByAdminQuery();

    $query = $this->db->get();
    return $query->num_rows();
  }

  public function updateProduct($id_product, $id_category, $product_name, $product_desc, $product_price, $product_pict = null, $product_discount, $available) {
    if ($product_pict == null) {
      $this->db->query("
        UPDATE products SET
        id_category = '$id_category',
        product_name = '$product_name',
        product_desc = '$product_desc',
        product_price = '$product_price',
        product_discount = '$product_discount',
        available = '$available'
        WHERE id_product = $id_product
      ");
    } else {
      $this->db->query("
        UPDATE products SET
        id_category = '$id_category',
        product_name = '$product_name',
        product_desc = '$product_desc',
        product_price = '$product_price',
        product_pict = '$product_pict',
        product_discount = '$product_discount',
        available = '$available'
        WHERE id_product = $id_product
      ");
    }
  }

  public function addProduct($id_product, $id_category, $product_name, $product_desc, $product_price, $product_pict, $product_discount, $available) {
    $this->db->query("
      INSERT INTO products VALUES (
      '$id_product',
      '$id_category',
      '$product_name',
      '$product_desc',
      '$product_price',
      '$product_pict',
      '$product_discount',
      '$available')
    ");
  }

  public function deleteProduct($id_product) {
    $this->db->query("DELETE FROM products WHERE id_product = $id_product");
  }
}