<?php

/* ***** BEGIN LICENSE BLOCK *****
 *  
 * This file is part of ZenCart Google Sitemap Generater
 * 
 * The MIT License
 * 
 * Copyright (c) 2012 Jonathan Bradley (http://afzetinc.com)
 * All rights reserved.
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * ***** END LICENSE BLOCK *****
 *
 * Configuration File
 * 
 * @copyright   Copyright (C) 2012 Jonathan Bradley
 * @author      Jonathan Bradley <jonathan@afzetinc.com>
 * @license     http://www.opensource.org/licenses/MIT
 * @package     google_sitemap
 * @filename    class.generate.php
 */

class Generate {

  public function __construct () {
    $this->__fetchProducts ();
  }
  
  public function save () {
  
    $sitemap = $this->__generateXml();
  
    // remove duplciate sitemap
    if (file_exists(SITEMAP)) unlink(SITEMAP);
    
    // remove file to upload
    if (file_exists(G_SITEMAP)) unlink(G_SITEMAP);
    
    if (!file_exists(SITEMAP)) {
      $fh = fopen(SITEMAP, 'w') or die("can't open file");
      fwrite($fh, $sitemap);
      fclose($fh);
    }
    
    if (!file_exists(G_SITEMAP)) {
      copy(SITEMAP, G_SITEMAP);
    }

  
  }

  private function __fetchProducts () {
  
    $sql = "SELECT 
              pd.products_name, 
              p.products_id
            FROM products p 
               LEFT OUTER JOIN products_description pd ON p.products_id = pd.products_id
            WHERE 
                p.products_status = 1";
  
    $query = mysql_query($sql);
    
    while ($row = mysql_fetch_array($query)) {
      $this->products[$row['products_id']] = $row;
    }  
  
  }

  private function __generateXml () {  
        
    $f = 0;
    $i = 0;

    foreach ($this->products as $key => $value) {
    
      $xml[$i] = ' 
          <url> 
            <loc>http://'. SITE_URL .'/index.php?main_page=product_info&amp;products_id='. $value['products_id'] .'</loc> 
            <image:image>
               <image:loc>http://'. SITE_URL .'.com/images/'. $value['products_image'] .'</image:loc> 
            </image:image>

            <lastmod>'. date('Y-m-d') .'</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.00</priority>
          </url>
         ';

         if ($i % 50000)
            $f++;

    }     

    count ($xml);
    die; 
        
    $top = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="includes/templates/template_default/css/gss.xsl"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    $end = '</urlset>';


  
    $sitemap = $this->__generateXml();
  
    // remove duplciate sitemap
    if (file_exists(SITEMAP)) unlink(SITEMAP);
    
    // remove file to upload
    if (file_exists(G_SITEMAP)) unlink(G_SITEMAP);
    
    if (!file_exists(SITEMAP)) {
      $fh = fopen(SITEMAP, 'w') or die("can't open file");
      fwrite($fh, $sitemap);
      fclose($fh);
    }
    
    if (!file_exists(G_SITEMAP)) {
      copy(SITEMAP, G_SITEMAP);
    }
    
    return $xml;

  }

}