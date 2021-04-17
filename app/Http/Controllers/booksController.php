<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Exception;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cover;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class booksController extends Controller
{
    public function index(){
        $r = (object) array();
        try{
            $books = Book::paginate();
            $r = $books;
        }catch (Exception $e) {
            $r->message = $e->getMessage();
            $r->state = "Error";
        }
        echo json_encode($r);
    }

    public function books($ISBN){
        try{
            $data = Book::where('ISBN', $ISBN)->first();
            if($data === null) {
                throw new Exception("ISBN {$ISBN} no encontrado");;
            }
            #print_r($data); exit;
            /*
            $r->response = array(
                'book' => $a,
                'authors' => $a->authors,
                'covers' => $a->covers,
            );
            */
            return view('xml', ['data'=>$data]);
        }catch (Exception $e) {
            return view('errorXml');;
        }
    }

    public function delete($ISBN, Request $request){
        $r = (object) array();
        try{
            $a = Book::where('ISBN', $ISBN)->first();
            if($a === null) {
                throw new Exception("ISBN {$ISBN} no encontrado");;
            }
            $a->delete();
            $r->message = 'Libro Eliminado!';
            $r->status = 200;
        }catch (Exception $e) {
            $r->message = $e->getMessage();
            $r->state = "Error";
        }
        echo json_encode($r);
    }

    public function create($ISBN, Request $request){
        #$data = $request->{"ISBN:{$ISBN}"};
        #return $data['cover']['small']; exit;
        $r = (object) array();
        try{
            $data = $request->{"ISBN:{$ISBN}"};
            if($data === null) {
                throw new Exception("ISBN {$ISBN} coinside con la llave base!");
            }
            DB::beginTransaction();
            #Se crea lo autores primero
            $bookAuthors = [];
            for ($i=0; $i < count($data['authors']); $i++) { 
                $au = $data['authors'][$i];
                $author = new Author();
                $author->url = $au["url"];
                $author->name = $au["name"];
                $author->save();

                $au = Author::where('name', $au["name"])->first();
                array_push($bookAuthors, $au->id);
            }
            #Creación del libro
            $book = new Book();
            $book->ISBN = $ISBN;
            $book->url = $data['url'];
            $book->key = $data['key'];
            $book->title = $data['title'];
            $book->number_of_pages = $data['number_of_pages'];
            $book->publish_date = $data['publish_date'];
            $book->save();

            $book = Book::where('key', $data['key'])->first();
            $book->authors()->attach( $bookAuthors );

            #Creación de portada
            $infoCover = [
                'small' => $data['cover']['small'],
                'medium' => $data['cover']['medium'],
                'large' => $data['cover']['large'],
            ];
            $book->covers()->create($infoCover);

            DB::commit();
            $r->message = 'Libro Creado!';
            $r->status = 200;
        }catch (Exception $e) {
            DB::rollback();
            $r->message = $e->getMessage();
            $r->state = "Error";
        }
        echo json_encode($r);
    }

}
