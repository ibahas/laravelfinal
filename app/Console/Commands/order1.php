<?php

namespace App\Console\Commands;

use App\Orders;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class order1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:delivered';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Change Status orders to delivered ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
          //
        //   $rows = Orders::all();
        //   foreach($rows as $row) {
        //       $row->status = 1;
        //       $row->save();
        //   }
          $this->line('<fg=black;bg=white;>All Orders is delivered</> ');
          // print_r($rows);
  
          $this->line("\n");
          $this->line('<fg=green;>This Table can you see status orders just delivered... </>' . "\n");
                  // Create a new Table instance.
              $table = new Table($this->output);
  
              // Set the table headers.
              $table->setHeaders([
                 'id','product','user','status'
              ]);
              
              $abc = Orders::all();
              $rowsa = [];
              foreach($abc as $rowss) {
                  if($rowss->status == 1){

                      $file = (object) [
                          'id' => $rowss->id,
                          'prdouct' => $rowss->product,
                          'user' => $rowss->user,
                          'status' => $rowss->status,
                       ];
                         $rowsa[] = [$file->id,$file->prdouct,$file->user,'<fg=green;>' . $file->status . '</>'];
                      
                  }
              }
  
              // Set the contents of the table.
              $table->setRows($rowsa);
  
              // Render the table to the output.
              $table->render();
  
    }
}
