<?php

class Animal {
    public $animals;

    public function __construct($ar_animals) 
    {
        $this->animals = $ar_animals;
    }

    public function index()
    {
        foreach ($this->animals as $animal) {
            echo "- $animal <br/>";
        }
    }
    public function store($animal) {
        $this->animals[] = $animal;
    }

    public function update($index, $animal) {
        $this->animals[$index] = $animal;

    }

    public function destroy($index) {
        unset($this->animals[$index]);
    }
}

$animal = new Animal(["Ayam", "Ikan"]);

echo "Index - Menampilkan seluruh hewan <br/>";
$animal->index();
echo "<br/>";

#method Store
echo "Store - Menambahkan hewan baru (burung) <br/>";
$animal->store("burung");
$animal->index();
echo "<br/>";

#method Update
echo "Update - Mengupdate hewan <br/>";
$animal->update(0, "Kucing Anggora");
$animal->index();
echo "<br/>";

echo "Destroy - Menghapus hewan <br/>";
$animal->destroy("1");
$animal->index();
echo "<br/>";





