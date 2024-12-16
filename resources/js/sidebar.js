export function initializeSidebar() {
  const sidebar = document.getElementById('sidebar');
  const collapseBtn = document.getElementById('collapse-btn');
  const mainContent = document.getElementById('main-content');
  const logoText = document.getElementById('logo-text');
  const logoLetter = document.getElementById('logo-letter');
  const sidebarTextElements = document.querySelectorAll('.sidebar-text');
  const collapseIcon = document.getElementById('collapse-icon');

  // Set initial state based on screen size
  let isCollapsed = window.innerWidth < 768;

  function updateSidebarState() {
    if (isCollapsed) {
      collapseSidebar();
    } else {
      expandSidebar();
    }
  }

  function collapseSidebar() {
    sidebar.classList.add('collapsed');
    sidebar.style.width = '4rem';
    mainContent.style.marginLeft = window.innerWidth < 768 ? '4rem' : '4rem';
    logoLetter.classList.add('scale-75');
    logoText.style.opacity = '0';
    logoText.style.width = '0';
    sidebarTextElements.forEach((el) => {
      el.style.opacity = '0';
      el.style.width = '0';
    });
    collapseIcon.style.transform = 'rotate(180deg)';
  }

  function expandSidebar() {
    sidebar.classList.remove('collapsed');
    sidebar.style.width = '16rem';
    mainContent.style.marginLeft = '16rem';
    logoLetter.classList.remove('scale-75');
    logoText.style.opacity = '1';
    logoText.style.width = 'auto';
    sidebarTextElements.forEach((el) => {
      el.style.opacity = '1';
      el.style.width = 'auto';
    });
    collapseIcon.style.transform = '';
  }

  function handleResponsiveLayout() {
    const width = window.innerWidth;

    if (width < 1024) {
      collapseSidebar();
    } else if (!isCollapsed) {
      expandSidebar();
    }
  }

  // Initialize event listeners
  window.addEventListener('load', () => {
    if (window.innerWidth < 768) {
      collapseSidebar();
    }
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth < 768 && !isCollapsed) {
      collapseSidebar();
    }
  });

  collapseBtn.addEventListener('click', () => {
    isCollapsed = !isCollapsed;
    updateSidebarState();
  });

  // Add resize listener
  window.addEventListener('resize', handleResponsiveLayout);

  // Initial calls
  updateSidebarState();
  handleResponsiveLayout();
}
