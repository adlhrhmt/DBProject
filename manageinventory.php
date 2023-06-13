<!--Purpose: Expert can edit their publication list -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php
    session_start();

    ?>

    //<?php include "components/navigation.php"; ?>

    <div class="container-fluid px-5">
        <h3 class="mt-5">Inventory List</h3>
        <div class="card text-left w-90">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inventory</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="database/deleteproduct.php" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Selling Price</th>
                                <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            include "database/db.php";

                            // Query to retrieve publicationTitle and publicationCategory from the publication table
                            $sql = "SELECT  product_name, category, selling, balance FROM products";
                            $result = $conn->query($sql);

                            // Iterate through the fetched data and populate table rows
                            $rowNumber = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th scope="row">' . $rowNumber . '</th>';
                                echo '<td>' . $row['product_name'] . '</td>';
                                echo '<td>' . $row['category'] . '</td>';
                                echo '<td>' . $row['selling'] . '</td>';
                                echo '<td>' . $row['balance'] . '</td>';
                                echo '<td>';
                                echo '<input type="checkbox" name="selectedProduct[]" value="' . $row['product_name'] . '">';
                                echo '</td>';
                                echo '</tr>';
                                $rowNumber++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" name="deleteSelected" class="btn btn-outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                            Delete
                        </button>
                        <div style="margin-left: 10px;"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="add">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                            </svg>
                            Add
                        </button>
                    </div>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="database/addproduct.php" method="post">
                                    <div class="mb-3">
                                        <label for="product_name" class="col-form-label">Product:</label>
                                        <input type="text" class="form-control" name="product_name" id="product_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_code" class="col-form-label">Code:</label>
                                        <input type="text" class="form-control" name="product_code" id="product_code">
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="col-form-label">Type:</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="" disabled selected>Click For Options</option>
                                            <option value="PRODUCT">Product</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category" class="col-form-label">Category:</label>
                                        <input type="text" class="form-control" name="category" id="category">
                                    </div>
                                    <div class="mb-3">
                                        <label for="uom" class="col-form-label">UOM:</label>
                                        <select class="form-control" name="uom" id="uom">
                                            <option value="" disabled selected>Click For Options</option>
                                            <option value="UNIT">UNIT</option>
                                            <option value="BOX">BOX</option>
                                            <option value="CASE">CASE</option>
                                            <option value="PCS">PCS</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cost" class="col-form-label">Cost:</label>
                                        <input type="text" class="form-control" name="cost" id="cost">
                                    </div>
                                    <div class="mb-3">
                                        <label for="selling" class="col-form-label">Selling Price:</label>
                                        <input type="text" class="form-control" name="selling" id="selling">
                                    </div>
                                    <div class="mb-3">
                                        <label for="balance" class="col-form-label">Balance:</label>
                                        <input type="text" class="form-control" name="balance" id="balance">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>