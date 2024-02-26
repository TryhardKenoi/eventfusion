<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DualListbox from AdminLTE</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <!-- DualListbox CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.1/jquery.bootstrap-duallistbox.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <select multiple="multiple" size="8" id="duallistbox">
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
          <option value="4">Option 4</option>
          <option value="5">Option 5</option>
        </select>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
  <!-- DualListbox JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.1/jquery.bootstrap-duallistbox.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#duallistbox').bootstrapDualListbox({
        // Možné přizpůsobení podle dokumentace DualListbox
      });
    });
  </script>
</body>
</html>