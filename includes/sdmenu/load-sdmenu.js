var myMenu = new SDMenu("my_menu"); // ID of the menu element
// Default values...
myMenu.speed = 3;                     // Menu sliding speed (1 - 5 recomended)
myMenu.remember = true;               // Store menu states (expanded or collapsed) in cookie and restore later
myMenu.oneSmOnly = false;             // One expanded submenu at a time
myMenu.markCurrent = true;            // Mark current link / page (link.href == location.href)

myMenu.init();

// Additional methods...
//var firstSubmenu = myMenu.submenus[0];
//myMenu.expandMenu(firstSubmenu);      // Expand a submenu
//myMenu.collapseMenu(firstSubmenu);    // Collapse a menu
//myMenu.toggleMenu(firstSubmenu);      // Expand if collapsed and collapse if expanded

//myMenu.expandAll();                   // Expand all submenus
//myMenu.collapseAll();                 // Collapse all submenus