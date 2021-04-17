<?xml version="1.0" encoding="utf-8" standalone="yes" ?>
<Libros>
    <Libro>
        <Titulo>{{ $data->title }}</Titulo>
        <Isbn>{{ $data->ISBN }}</Isbn>
        <Autores>
            @foreach (  $data->authors as $author)
                <Autor>{{ $author->name }}</Autor>
            @endforeach
        </Autores>
        <Caratula>{{ $data->covers->medium }}</Caratula>
    </Libro>
</Libros>