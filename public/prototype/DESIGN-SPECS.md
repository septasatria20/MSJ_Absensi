# MSJ ABSENSI - Design Specifications

Complete design specifications untuk recreate di Figma.

## 🎨 Color Palette

### Primary Colors
```css
--primary: #0A9294          /* Sage Green - Main brand color */
--primary-dark: #067678     /* Darker Sage - Hover states */
--primary-light: #0dB5B8    /* Lighter Sage - Backgrounds */
```

### Semantic Colors
```css
--success: #2dce89          /* Green - Success states */
--success-bg: #d4edda       /* Light green - Success badges */
--success-text: #155724     /* Dark green - Success text */

--warning: #fb6340          /* Orange - Warning states */
--warning-bg: #fff3cd       /* Light orange - Warning badges */
--warning-text: #856404     /* Dark orange - Warning text */

--danger: #f5365c           /* Red - Danger/Error states */
--danger-bg: #f8d7da        /* Light red - Danger badges */
--danger-text: #721c24      /* Dark red - Danger text */

--info: #11cdef             /* Blue - Info states */
--info-bg: #d1ecf1          /* Light blue - Info badges */
--info-text: #0c5460        /* Dark blue - Info text */
```

### Neutral Colors
```css
--gray-900: #32325d         /* Headings, dark text */
--gray-800: #525f7f         /* Body text */
--gray-600: #8898aa         /* Secondary text, labels */
--gray-400: #dee2e6         /* Borders, dividers */
--gray-200: #e9ecef         /* Light borders */
--gray-100: #f7fafc         /* Backgrounds, hover states */
--white: #ffffff            /* Cards, backgrounds */
```

### Special Colors
```css
--whatsapp: #25D366         /* WhatsApp button */
--whatsapp-dark: #128C7E    /* WhatsApp hover */
```

## 📝 Typography

### Font Family
```css
font-family: 'Open Sans', 'Segoe UI', Tahoma, sans-serif;
```

### Font Sizes & Weights

**Display / Large Headings**
```
Size: 48px
Weight: 700 (Bold)
Line Height: 1.2
Use: Hero titles, main headers
```

**Heading 1 (Page Title)**
```
Size: 28px
Weight: 700 (Bold)
Line Height: 1.3
Color: #32325d
Use: Main page titles
```

**Heading 2 (Section Title)**
```
Size: 20px
Weight: 700 (Bold)
Line Height: 1.4
Color: #32325d
Use: Card titles, section headers
```

**Heading 3 (Card Title)**
```
Size: 18px
Weight: 700 (Bold)
Line Height: 1.4
Color: #32325d
Use: Card headers, modal titles
```

**Body Text**
```
Size: 14px
Weight: 400 (Regular)
Line Height: 1.5
Color: #525f7f
Use: Regular text, table cells
```

**Small Text**
```
Size: 12px
Weight: 400/600 (Regular/Semi-bold)
Line Height: 1.4
Color: #8898aa
Use: Labels, captions, badges
```

**Tiny Text**
```
Size: 11px
Weight: 700 (Bold)
Line Height: 1.3
Color: #8898aa
Text Transform: uppercase
Letter Spacing: 0.5px
Use: Table headers, filter labels
```

## 📐 Spacing System

### Padding
```css
--space-xs: 8px      /* Tight spacing */
--space-sm: 12px     /* Small spacing */
--space-md: 15px     /* Default gap */
--space-lg: 20px     /* Large spacing */
--space-xl: 25px     /* Extra large (card padding) */
--space-2xl: 30px    /* Page margins */
--space-3xl: 40px    /* Section gaps */
```

### Margin
```css
--margin-sm: 5px     /* Small margin */
--margin-md: 10px    /* Medium margin */
--margin-lg: 20px    /* Large margin */
--margin-xl: 30px    /* Extra large margin */
```

### Gap (for Flexbox/Grid)
```css
--gap-xs: 8px
--gap-sm: 10px
--gap-md: 15px
--gap-lg: 20px
```

## 🔲 Border & Radius

### Border Width
```css
--border-thin: 1px
--border-medium: 2px
--border-thick: 4px (left accent on cards)
```

### Border Radius
```css
--radius-sm: 4px     /* Small elements */
--radius-md: 6px     /* Buttons, inputs */
--radius-lg: 8px     /* Mini cards */
--radius-xl: 10px    /* Main cards */
--radius-2xl: 12px   /* Large containers */
--radius-pill: 20px  /* Badges */
--radius-circle: 50% /* Avatars, icons */
```

### Border Colors
```css
--border-light: #e9ecef
--border-default: #dee2e6
--border-dark: #8898aa
--border-primary: #0A9294 (focus state)
```

## 🌑 Shadows

### Box Shadows
```css
/* Light shadow - Cards, containers */
box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);

/* Medium shadow - Hover states */
box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);

/* Strong shadow - Modals, elevated elements */
box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);

/* Navbar shadow */
box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);

/* Button hover shadow */
box-shadow: 0 5px 12px rgba(10, 146, 148, 0.3); /* with primary color */
```

### Focus Shadow
```css
box-shadow: 0 0 0 3px rgba(10, 146, 148, 0.1);
```

## 🎯 Component Specifications

### Buttons

**Primary Button**
```
Background: linear-gradient(135deg, #0A9294 0%, #067678 100%)
Color: #ffffff
Padding: 10px 20px (medium), 14px (large)
Border Radius: 6px
Font Size: 14px (medium), 15px (large)
Font Weight: 600
Text Transform: uppercase (for large buttons)
Letter Spacing: 0.5px

Hover:
  Transform: translateY(-2px)
  Shadow: 0 5px 12px rgba(10, 146, 148, 0.3)

Active:
  Transform: translateY(0)
```

**Small Button**
```
Padding: 6px 12px
Font Size: 13px
Border Radius: 4px
```

**WhatsApp Button**
```
Background: #25D366
Color: #ffffff
Icon: 📱 (before text)

Hover:
  Background: #128C7E
  Shadow: 0 3px 8px rgba(37, 211, 102, 0.3)
```

**Secondary/Info Buttons**
```
Success: #2dce89
Info: #11cdef
Warning: #fb6340
Danger: #f5365c
```

### Cards

**Standard Card**
```
Background: #ffffff
Border Radius: 10px
Shadow: 0 2px 10px rgba(0, 0, 0, 0.08)
Overflow: hidden (for rounded corners)

Card Header:
  Padding: 20px 25px
  Border Bottom: 1px solid #e9ecef

Card Body:
  Padding: 25px

Hover (optional):
  Transform: translateY(-4px)
  Shadow: 0 4px 15px rgba(0, 0, 0, 0.12)
```

**Stat Card**
```
Background: #ffffff
Border Radius: 10px
Padding: 20px
Display: flex
Align Items: center
Gap: 15px
Shadow: 0 2px 10px rgba(0, 0, 0, 0.08)

Icon Container:
  Width: 60px
  Height: 60px
  Border Radius: 10px
  Background: linear-gradient(135deg, #0A9294 0%, #067678 100%)
  Color: #ffffff
  Font Size: 24px (emoji) or 28px (number)
```

**Alert Card**
```
Background: #fff3cd (warning)
Border Left: 4px solid #ffc107
Color: #856404
Padding: 15px 20px
Border Radius: 8px
Display: flex
Align Items: center
Gap: 12px

Icon: 24px
```

### Forms

**Input / Form Control**
```
Width: 100%
Padding: 10px 12px
Font Size: 14px
Border: 1px solid #dee2e6
Border Radius: 6px
Color: #525f7f

Focus:
  Outline: none
  Border Color: #0A9294
  Shadow: 0 0 0 3px rgba(10, 146, 148, 0.1)

Placeholder:
  Color: #8898aa
  Opacity: 0.7
```

**Time Picker**
```
Type: time
(Same styles as input above)
Icon: Clock icon (browser default or custom)
```

**Select Dropdown**
```
(Same styles as input)
Arrow: Default browser or custom SVG
```

**Label**
```
Display: block
Font Size: 14px
Font Weight: 600
Color: #32325d
Margin Bottom: 8px
```

**Filter Label (uppercase)**
```
Font Size: 12px
Font Weight: 700
Color: #8898aa
Text Transform: uppercase
Letter Spacing: 0.5px
```

### Tables

**Data Table**
```
Width: 100%
Border Collapse: collapse

Table Head:
  Background: #f7fafc

Table Header Cell (th):
  Padding: 14px 12px
  Text Align: left
  Font Size: 11px (or 12px)
  Font Weight: 700
  Color: #8898aa
  Text Transform: uppercase
  Border Bottom: 2px solid #e9ecef

Table Data Cell (td):
  Padding: 14px 12px (or 16px 12px)
  Font Size: 14px
  Color: #525f7f
  Border Bottom: 1px solid #f7fafc

Row Hover:
  Background: #f7fafc
```

### Badges

**Badge (base)**
```
Display: inline-block
Padding: 4px 12px (or 5px 12px)
Border Radius: 20px
Font Size: 12px
Font Weight: 600
```

**Badge Variants**
```
Success:
  Background: #d4edda
  Color: #155724

Warning:
  Background: #fff3cd
  Color: #856404

Danger:
  Background: #f8d7da
  Color: #721c24

Info:
  Background: #d1ecf1
  Color: #0c5460
```

### Navbar

**Navbar Container**
```
Background: linear-gradient(135deg, #0A9294 0%, #067678 100%)
Padding: 15px 30px
Display: flex
Justify Content: space-between
Align Items: center
Shadow: 0 2px 8px rgba(0, 0, 0, 0.1)

Brand:
  Color: #ffffff
  Font Size: 20px
  Font Weight: 700

User Section:
  Color: #ffffff
  Font Size: 14px
  Display: flex
  Align Items: center
  Gap: 15px

Avatar:
  Width: 36px
  Height: 36px
  Border Radius: 50%
  Background: rgba(255, 255, 255, 0.2)
  Font Weight: 600
```

### Modal

**Modal Overlay**
```
Position: fixed
Top: 0, Left: 0
Width: 100%, Height: 100%
Background: rgba(0, 0, 0, 0.5)
Z-index: 1000
Display: flex
Align Items: center
Justify Content: center
```

**Modal Content**
```
Background: #ffffff
Border Radius: 10px
Max Width: 600px
Width: 90%
Max Height: 90vh
Overflow Y: auto

Modal Header:
  Padding: 20px 25px
  Border Bottom: 1px solid #e9ecef

Modal Body:
  Padding: 25px

Modal Footer:
  Padding: 20px 25px
  Border Top: 1px solid #e9ecef
  Display: flex
  Justify Content: flex-end
  Gap: 10px
```

### Pagination

**Pagination Container**
```
Display: flex
Justify Content: center
Gap: 5px
Margin Top: 20px
```

**Page Item**
```
Padding: 8px 12px
Border: 1px solid #dee2e6
Border Radius: 4px
Cursor: pointer
Font Size: 14px
Background: #ffffff
Transition: all 0.2s

Hover:
  Background: #0A9294
  Color: #ffffff
  Border Color: #0A9294

Active:
  Background: #0A9294
  Color: #ffffff
  Border Color: #0A9294
```

### Calendar

**Calendar Grid**
```
Display: grid
Grid Template Columns: repeat(7, 1fr)
Gap: 8px
```

**Calendar Day Header**
```
Padding: 12px
Text Align: center
Font Size: 12px
Font Weight: 700
Color: #8898aa
Text Transform: uppercase
```

**Calendar Day**
```
Padding: 15px
Text Align: center
Background: #f7fafc
Border Radius: 6px
Font Size: 14px
Color: #525f7f
Cursor: pointer

Hover:
  Background: #e9ecef

Today:
  Background: #0A9294
  Color: #ffffff
  Font Weight: 700

Holiday:
  Background: #f5365c
  Color: #ffffff
```

## 📱 Responsive Breakpoints

```css
/* Mobile */
@media (max-width: 767px) {
  /* Stack grids vertically */
}

/* Tablet */
@media (min-width: 768px) and (max-width: 1023px) {
  /* 2 columns for grids */
}

/* Desktop */
@media (min-width: 1024px) {
  /* Full grid layout */
}
```

## 🎭 Transitions & Animations

**Standard Transition**
```
transition: all 0.2s ease;
```

**Button Hover**
```
transition: all 0.2s ease;
transform: translateY(-2px);
```

**Card Hover**
```
transition: all 0.3s ease;
transform: translateY(-4px);
```

## 📏 Layout Grid

**Container Max Width**
```
Dashboard: 1400px
Standard Pages: 1200px
Forms: 600px
```

**Grid Templates**
```css
/* Stats Grid - Auto-fit cards */
grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
gap: 20px;

/* Charts Grid - 2 columns */
grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
gap: 20px;

/* Filter Section - Responsive */
grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
gap: 20px;
```

---

## 💡 Usage Tips for Figma

1. **Create Color Styles**: Buat color styles untuk semua warna di palette
2. **Create Text Styles**: Buat text styles untuk setiap typography variant
3. **Create Components**: Button, Badge, Card, Form Input sebagai components
4. **Use Auto Layout**: Gunakan auto layout untuk responsive spacing
5. **Create Variants**: Badge variants, Button variants
6. **Setup Grid**: 8px base grid untuk consistency

---

**Design System Version**: 1.0  
**Last Updated**: 11 Februari 2026  
**Compatible with**: Figma, Adobe XD, Sketch
