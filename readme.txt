welcome-popup-manager/
│
├── admin/              # SOLO código específico del WP Admin
│   ├── AdminMenu.php
│   ├── AdminAssets.php
│   ├── SettingsPageController.php
│   ├── SettingsRegistry.php
│   └── fields/
│       ├── DescriptionField.php
│       ├── LinkField.php
│       ├── ImageField.php
│       ├── DelayEnabledField.php
│       ├── DelaySecondsField.php
│       └── DisplayModeField.php
│
├── public/             # UI del sitio (frontend)
│   ├── PopupRenderer.php
│   ├── assets/
│   │   ├── popup.js
│   │   └── popup.css
│   └── views/
│       └── popup.php
│
├── domain/             # LÓGICA DE NEGOCIO (agnóstica de WP)
│   ├── Settings.php
│   ├── SettingsSanitizer.php
│   └── PopupRules.php
│
├── views/              # Vistas compartidas (NO admin / NO public)
│   └── admin-settings-page.php
│
├── bootstrap/
│   └── admin.php
│   └── public.php
│
└── welcome-popup-manager.php