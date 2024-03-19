  $(document).ready(function() {
    $('#users').bootstrapDualListbox({
      nonSelectedListLabel: 'Nezvolené',
      selectedListLabel: 'Zvolené',
      preserveSelectionOnMove: 'přesunuté', 
      moveOnSelect: false, 
      filterTextClear: 'zobrazit vše',
      filterPlaceHolder: 'Filtr',  
      moveSelectedLabel: 'Přesunout zvolené',
      moveAllLabel: 'Přesunout vše',  
      removeSelectedLabel: 'Odebrat zvolené',  
      removeAllLabel: 'Odebrat vše', 
      infoText: 'Zobrazuje všechny {0}', 
      infoTextEmpty: 'Prázdný seznam'  
    });

    $('#groups').bootstrapDualListbox({
      nonSelectedListLabel: 'Nezvolené',  
      selectedListLabel: 'Zvolené', 
      preserveSelectionOnMove: 'přesunuté',  
      moveOnSelect: false, 
      filterTextClear: 'zobrazit vše',  
      filterPlaceHolder: 'Filtr',  
      moveSelectedLabel: 'Přesunout zvolené', 
      moveAllLabel: 'Přesunout vše', 
      removeSelectedLabel: 'Odebrat zvolené', 
      removeAllLabel: 'Odebrat vše', 
      infoText: 'Zobrazuje všechny {0}', 
      infoTextEmpty: 'Prázdný seznam' 
      
    });
  });