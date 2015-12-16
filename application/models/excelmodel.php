<?php

class Excelmodel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->library('excel');
        $this->load->model('Products_model');
    }

    function generate_qty($type){
        $date = date('d.m.Y');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Прайс-лист на '.$date);

        // Титул
        $this->excel->getActiveSheet()->setCellValue("B1", 'Прайс-лист на '.$date);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setName('Arial');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        
        //Артикул
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(19);
        $this->excel->getActiveSheet()->setCellValue('A3', 'Артикул');
        $this->excel->getActiveSheet()->setCellValue('A6', '');
        $this->excel->getActiveSheet()->mergeCells('A3:A5');
        $style = array(
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
          )
        );
        $this->excel->getActiveSheet()->getStyle("A3:A5")->applyFromArray($style);

        //Номенклатура
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $this->excel->getActiveSheet()->setCellValue('B3', 'Номенклатура');
        $this->excel->getActiveSheet()->setCellValue('B4', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('B6', '');
        $style = array(
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
          )
        );
        $this->excel->getActiveSheet()->getStyle("B3")->applyFromArray($style);

        // Roz
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(19);
        $this->excel->getActiveSheet()->setCellValue('C3', 'Оптовые');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Руб');
        $this->excel->getActiveSheet()->setCellValue('C5', 'Включает НДС');
        $this->excel->getActiveSheet()->setCellValue('C6', 'Цена');
        $style = array(
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
          )
        );
        $this->excel->getActiveSheet()->getStyle("C3:C6")->applyFromArray($style);

        //Opt
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(19);
        $this->excel->getActiveSheet()->setCellValue('D3', 'Розничные');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Руб');
        $this->excel->getActiveSheet()->setCellValue('D5', '');
        $this->excel->getActiveSheet()->setCellValue('D6', 'Цена');

        // Ost
		    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(19);
        $this->excel->getActiveSheet()->setCellValue('E3', 'Остатки по складам');
        $this->excel->getActiveSheet()->setCellValue('E6', 'Остаток');
        $this->excel->getActiveSheet()->mergeCells('E3:E5');
        $style = array(
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
          )
        );
        $this->excel->getActiveSheet()->getStyle("E3:E5")->applyFromArray($style);


        //BORDER
        $this->excel->getActiveSheet()->getStyle("A3:E6")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'ccc085')
                )
            ),
            'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('rgb' => 'f4ecc5')
            ),
            'font'  => array(
                'size'  => 10,
                'name'  => 'Arial'
            )
        ));

        $this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(12.75);
        $this->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(12.75);
        $this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(12.75);
        $this->excel->getActiveSheet()->getRowDimension('5')->setRowHeight(12.75);
        $this->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(12.75);

        $i=7;

        $catmain = 0;

        foreach ($this->main_cat() as $main_cat) {
          //Категория
          $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $main_cat->name);
          $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
          $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'ccc085')
                )
            ),
            'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('rgb' => 'f8f2d8')
            ),
            'font'  => array(
                'size'  => 12,
                'name'  => 'Arial',
                'bold'  =>  true
            )
          ));
          $i++;

          //ТОВАРЫ В ГЛАВНОЙ          
          foreach($this->list_product($main_cat->guid) as $one): 
          $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'ccc085')
                )
            ),
            'font'  => array(
                'size'  => 8,
                'name'  => 'Arial'
            )
          ));
          $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);

          $test = $this->Products_model->test_char($one->product_guid);

          if($test['num'] == 1)
          {
            foreach($this->Products_model->get_chars_name($one->product_guid) as $chars):
              $char_type[]= $chars->name;
            endforeach;
            foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $row):
              $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => 'ccc085')
                    )
                ),
                'font'  => array(
                    'size'  => 8,
                    'name'  => 'Arial'
                )
              ));
              $aling_style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
              $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name.', '.$row->name);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
           
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_char_num($one->product_guid, $row->char_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $i++;
        
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
            endforeach;
            unset($char_type);
          }
          else
          {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
                
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 
           
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_num($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $i++;
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
          }
        endforeach;

        foreach ($this->sub_cat($main_cat->guid) as $subcat) {
          $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, '    '.$subcat->name);
          $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
          $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'ccc085')
                )
            ),
            'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('rgb' => 'f8f2d8')
            ),
            'font'  => array(
                'size'  => 12,
                'name'  => 'Arial',
                'bold'  =>  true
            )
          ));
          $i++;

          foreach($this->list_product($subcat->guid) as $one): 
          $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'ccc085')
                )
            ),
            'font'  => array(
                'size'  => 8,
                'name'  => 'Arial'
            )
          ));
          $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);

          $test = $this->Products_model->test_char($one->product_guid);

          if($test['num'] == 1)
          {
            foreach($this->Products_model->get_chars_name($one->product_guid) as $chars):
              $char_type[]= $chars->name;
            endforeach;
            foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $row):
              $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => 'ccc085')
                    )
                ),
                'font'  => array(
                    'size'  => 8,
                    'name'  => 'Arial'
                )
              ));
              $aling_style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
              $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name.', '.$row->name);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
           
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_char_num($one->product_guid, $row->char_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $i++;
        
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
            endforeach;
            unset($char_type);
          }
          else
          {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
                
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 
           
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_num($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $i++;
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
          }
        endforeach;
          //SUBCAT2
          foreach ($this->sub_cat($subcat->guid) as $subcat2) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, '        '.$subcat2->name);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
            $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN,
                      'color' => array('rgb' => 'ccc085')
                  )
              ),
              'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'f8f2d8')
              ),
              'font'  => array(
                  'size'  => 12,
                  'name'  => 'Arial',
                  'bold'  =>  true
              )
            ));
            $i++;
            foreach($this->list_product($subcat2->guid) as $one): 
          $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'ccc085')
                )
            ),
            'font'  => array(
                'size'  => 8,
                'name'  => 'Arial'
            )
          ));
          $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);

          $test = $this->Products_model->test_char($one->product_guid);

          if($test['num'] == 1)
          {
            foreach($this->Products_model->get_chars_name($one->product_guid) as $chars):
              $char_type[]= $chars->name;
            endforeach;
            foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $row):
              $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => 'ccc085')
                    )
                ),
                'font'  => array(
                    'size'  => 8,
                    'name'  => 'Arial'
                )
              ));
              $aling_style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
              $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name.', '.$row->name);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
           
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_char_num($one->product_guid, $row->char_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $i++;
        
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
            endforeach;
            unset($char_type);
          }
          else
          {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
                
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 
           
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_num($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $i++;
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
          }
        endforeach;

            foreach ($this->sub_cat($subcat2->guid) as $subcat3) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, '            '.$subcat3->name);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
            $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN,
                      'color' => array('rgb' => 'ccc085')
                  )
              ),
              'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'f8f2d8')
              ),
              'font'  => array(
                  'size'  => 12,
                  'name'  => 'Arial',
                  'bold'  =>  true
              )
            ));
            $i++;
            foreach($this->list_product($subcat3->guid) as $one): 
          $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'ccc085')
                )
            ),
            'font'  => array(
                'size'  => 8,
                'name'  => 'Arial'
            )
          ));
          $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);

          $test = $this->Products_model->test_char($one->product_guid);

          if($test['num'] == 1)
          {
            foreach($this->Products_model->get_chars_name($one->product_guid) as $chars):
              $char_type[]= $chars->name;
            endforeach;
            foreach($this->Products_model->get_chars($one->product_guid, $char_type[0]) as $row):
              $this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray(array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => 'ccc085')
                    )
                ),
                'font'  => array(
                    'size'  => 8,
                    'name'  => 'Arial'
                )
              ));
              $aling_style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
              $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(12.75);
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name.', '.$row->name);
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
           
              $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_char_num($one->product_guid, $row->char_guid));
              $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $i++;
        
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);

            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
            endforeach;
            unset($char_type);
          }
          else
          {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $one->articule);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment();

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $one->name);
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment();
                
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->Products_model->get_price($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $this->Products_model->get_price_type($one->product_guid, $type));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 
           
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $this->Products_model->get_remain_num($one->product_guid));
            $this->excel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $i++;
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setOutlineLevel(1);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setVisible(false);
            $this->excel->getActiveSheet()->getRowDimension($i-1)->setCollapsed(true);
            $this->excel->getActiveSheet()->setShowSummaryBelow(false);
          }
        endforeach;
            }
          }
          // END SUBCAT2

        }

          //КОНЕЦ КАТЕГОРИИ
        }
               
        $filename='price.xls';
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
    }

    function main_cat()
    {
      return $this->db->get_where('cathegory', array('parent' => '0', 'status' => '1'))->result();
    }

    function sub_cat($id)
    {
      return $this->db->get_where('cathegory', array('parent' => $id, 'status' => '1'))->result();
    }

    function list_product($cat){
      $products = $this->db->query('
        SELECT 
          products.guid as product_guid, 
          products.name,
          products.articule,
          GROUP_CONCAT(product_images.path) as image_path, 
          product_images.name as image_name
        FROM products
        LEFT JOIN product_images ON product_images.product_guid=products.guid
        WHERE category="'.$cat.'" AND products.status !=0 
        GROUP BY products.guid');
          
      return $products->result(); 
    }
    	 

}