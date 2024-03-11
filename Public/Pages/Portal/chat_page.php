<!doctype html>
<html lang="en" dir="ltr">

<head>
  <?php
  include("./Public/Pages/Common/header.php");
  include "./Public/Pages/Common/auth_user.php";

  // Function to echo the script for toastr
  function echoToastScript($type, $message)
  {
    echo "<script type='text/javascript'>document.addEventListener('DOMContentLoaded', function() { toastr['$type']('$message'); });</script>";
  }

  // Check if there's a toast message set in session, display it, then unset
  // print_r($_SESSION);
  if (isset($_SESSION['toast'])) {
    $toast = $_SESSION['toast'];
    echoToastScript($toast['type'], $toast['message']);
    unset($_SESSION['toast']); // Clear the toast message from session
  }

  if (session_status() !== PHP_SESSION_ACTIVE) session_start();

  // Display error message if available
  if (isset($_SESSION['login_error'])) {
    echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']); // Clear the error message
  }

  // print($uri);
  print_r($_SESSION);
  ?>
  <style>
    :root {
      /* This color palletes from Tailwind CSS */
      --white: #fff;
      --black: #000;

      --slate-50: #f8fafc;
      --slate-100: #f1f5f9;
      --slate-200: #e2e8f0;
      --slate-300: #cbd5e1;
      --slate-400: #94a3b8;
      --slate-500: #64748b;
      --slate-600: #475569;
      --slate-700: #334155;
      --slate-800: #1e293b;
      --slate-900: #0f172a;
      --slate-950: #020617;

      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-400: #9ca3af;
      --gray-500: #6b7280;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-800: #1f2937;
      --gray-900: #111827;
      --gray-950: #030712;

      --zinc-50: #fafafa;
      --zinc-100: #f4f4f5;
      --zinc-200: #e4e4e7;
      --zinc-300: #d4d4d8;
      --zinc-400: #a1a1aa;
      --zinc-500: #71717a;
      --zinc-600: #52525b;
      --zinc-700: #3f3f46;
      --zinc-800: #27272a;
      --zinc-900: #18181b;
      --zinc-950: #09090b;

      --neutral-50: #fafafa;
      --neutral-100: #f5f5f5;
      --neutral-200: #e5e5e5;
      --neutral-300: #d4d4d4;
      --neutral-400: #a3a3a3;
      --neutral-500: #737373;
      --neutral-600: #525252;
      --neutral-700: #404040;
      --neutral-800: #262626;
      --neutral-900: #171717;
      --neutral-950: #0a0a0a;

      --stone-50: #fafaf9;
      --stone-100: #f5f5f4;
      --stone-200: #e7e5e4;
      --stone-300: #d6d3d1;
      --stone-400: #a8a29e;
      --stone-500: #78716c;
      --stone-600: #57534e;
      --stone-700: #44403c;
      --stone-800: #292524;
      --stone-900: #1c1917;
      --stone-950: #0c0a09;

      --red-50: #fef2f2;
      --red-100: #fee2e2;
      --red-200: #fecaca;
      --red-300: #fca5a5;
      --red-400: #f87171;
      --red-500: #ef4444;
      --red-600: #dc2626;
      --red-700: #b91c1c;
      --red-800: #991b1b;
      --red-900: #7f1d1d;
      --red-950: #450a0a;

      --orange-50: #fff7ed;
      --orange-100: #ffedd5;
      --orange-200: #fed7aa;
      --orange-300: #fdba74;
      --orange-400: #fb923c;
      --orange-500: #f97316;
      --orange-600: #ea580c;
      --orange-700: #c2410c;
      --orange-800: #9a3412;
      --orange-900: #7c2d12;
      --orange-950: #431407;

      --amber-50: #fffbeb;
      --amber-100: #fef3c7;
      --amber-200: #fde68a;
      --amber-300: #fcd34d;
      --amber-400: #fbbf24;
      --amber-500: #f59e0b;
      --amber-600: #d97706;
      --amber-700: #b45309;
      --amber-800: #92400e;
      --amber-900: #78350f;
      --amber-950: #451a03;

      --yellow-50: #fefce8;
      --yellow-100: #fef9c3;
      --yellow-200: #fef08a;
      --yellow-300: #fde047;
      --yellow-400: #facc15;
      --yellow-500: #eab308;
      --yellow-600: #ca8a04;
      --yellow-700: #a16207;
      --yellow-800: #854d0e;
      --yellow-900: #713f12;
      --yellow-950: #422006;

      --lime-50: #f7fee7;
      --lime-100: #ecfccb;
      --lime-200: #d9f99d;
      --lime-300: #bef264;
      --lime-400: #a3e635;
      --lime-500: #84cc16;
      --lime-600: #65a30d;
      --lime-700: #4d7c0f;
      --lime-800: #3f6212;
      --lime-900: #365314;
      --lime-950: #1a2e05;

      --green-50: #f0fdf4;
      --green-100: #dcfce7;
      --green-200: #bbf7d0;
      --green-300: #86efac;
      --green-400: #4ade80;
      --green-500: #22c55e;
      --green-600: #16a34a;
      --green-700: #15803d;
      --green-800: #166534;
      --green-900: #14532d;
      --green-950: #052e16;

      --emerald-50: #ecfdf5;
      --emerald-100: #d1fae5;
      --emerald-200: #a7f3d0;
      --emerald-300: #6ee7b7;
      --emerald-400: #34d399;
      --emerald-500: #10b981;
      --emerald-600: #059669;
      --emerald-700: #047857;
      --emerald-800: #065f46;
      --emerald-900: #064e3b;
      --emerald-950: #022c22;

      --teal-50: #f0fdfa;
      --teal-100: #ccfbf1;
      --teal-200: #99f6e4;
      --teal-300: #5eead4;
      --teal-400: #2dd4bf;
      --teal-500: #14b8a6;
      --teal-600: #0d9488;
      --teal-700: #0f766e;
      --teal-800: #115e59;
      --teal-900: #134e4a;
      --teal-950: #042f2e;

      --cyan-50: #ecfeff;
      --cyan-100: #cffafe;
      --cyan-200: #a5f3fc;
      --cyan-300: #67e8f9;
      --cyan-400: #22d3ee;
      --cyan-500: #06b6d4;
      --cyan-600: #0891b2;
      --cyan-700: #0e7490;
      --cyan-800: #155e75;
      --cyan-900: #164e63;
      --cyan-950: #083344;

      --sky-50: #f0f9ff;
      --sky-100: #e0f2fe;
      --sky-200: #bae6fd;
      --sky-300: #7dd3fc;
      --sky-400: #38bdf8;
      --sky-500: #0ea5e9;
      --sky-600: #0284c7;
      --sky-700: #0369a1;
      --sky-800: #075985;
      --sky-900: #0c4a6e;
      --sky-950: #082f49;

      --blue-50: #eff6ff;
      --blue-100: #dbeafe;
      --blue-200: #bfdbfe;
      --blue-300: #93c5fd;
      --blue-400: #60a5fa;
      --blue-500: #3b82f6;
      --blue-600: #2563eb;
      --blue-700: #1d4ed8;
      --blue-800: #1e40af;
      --blue-900: #1e3a8a;
      --blue-950: #172554;

      --indigo-50: #eef2ff;
      --indigo-100: #e0e7ff;
      --indigo-200: #c7d2fe;
      --indigo-300: #a5b4fc;
      --indigo-400: #818cf8;
      --indigo-500: #6366f1;
      --indigo-600: #4f46e5;
      --indigo-700: #4338ca;
      --indigo-800: #3730a3;
      --indigo-900: #312e81;
      --indigo-950: #1e1b4b;

      --violet-50: #f5f3ff;
      --violet-100: #ede9fe;
      --violet-200: #ddd6fe;
      --violet-300: #c4b5fd;
      --violet-400: #a78bfa;
      --violet-500: #8b5cf6;
      --violet-600: #7c3aed;
      --violet-700: #6d28d9;
      --violet-800: #5b21b6;
      --violet-900: #4c1d95;
      --violet-950: #2e1065;

      --purple-50: #faf5ff;
      --purple-100: #f3e8ff;
      --purple-200: #e9d5ff;
      --purple-300: #d8b4fe;
      --purple-400: #c084fc;
      --purple-500: #a855f7;
      --purple-600: #9333ea;
      --purple-700: #7e22ce;
      --purple-800: #6b21a8;
      --purple-900: #581c87;
      --purple-950: #3b0764;

      --fuchsia-50: #fdf4ff;
      --fuchsia-100: #fae8ff;
      --fuchsia-200: #f5d0fe;
      --fuchsia-300: #f0abfc;
      --fuchsia-400: #e879f9;
      --fuchsia-500: #d946ef;
      --fuchsia-600: #c026d3;
      --fuchsia-700: #a21caf;
      --fuchsia-800: #86198f;
      --fuchsia-900: #701a75;
      --fuchsia-950: #4a044e;

      --pink-50: #fdf2f8;
      --pink-100: #fce7f3;
      --pink-200: #fbcfe8;
      --pink-300: #f9a8d4;
      --pink-400: #f472b6;
      --pink-500: #ec4899;
      --pink-600: #db2777;
      --pink-700: #be185d;
      --pink-800: #9d174d;
      --pink-900: #831843;
      --pink-950: #500724;

      --rose-50: #fff1f2;
      --rose-100: #ffe4e6;
      --rose-200: #fecdd3;
      --rose-300: #fda4af;
      --rose-400: #fb7185;
      --rose-500: #f43f5e;
      --rose-600: #e11d48;
      --rose-700: #be123c;
      --rose-800: #9f1239;
      --rose-900: #881337;
      --rose-950: #4c0519;
    }

    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');



    /* start: Globals */
    *,
    ::before,
    ::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font: inherit;
    }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--slate-700);
    }

    /* end: Globals */



    /* start: Chat */
    .chat-section {
      box-shadow: inset 0 160px 0 0 var(--emerald-500);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--slate-100);
    }

    .chat-container {
      max-width: 1360px;
      width: 100%;
      height: 720px;
      box-shadow: 0 8px 24px -4px rgba(0, 0, 0, .1);
      background-color: var(--white);
      position: relative;
    }

    /* end: Chat */



    /* start: Sidebar */
    .chat-sidebar {
      width: 64px;
      background-color: var(--slate-100);
      height: 100%;
      display: flex;
      flex-direction: column;
      position: absolute;
      left: 0;
      top: 0;
      z-index: 50;
    }

    .chat-sidebar-logo {
      font-size: 28px;
      color: var(--emerald-600);
      display: block;
      text-align: center;
      padding: 12px 8px;
      text-decoration: none;
    }

    .chat-sidebar-menu {
      list-style-type: none;
      display: flex;
      flex-direction: column;
      height: 100%;
      padding: 16px 0;
    }

    .chat-sidebar-menu>*>a {
      display: block;
      text-align: center;
      padding: 12px 8px;
      font-size: 24px;
      text-decoration: none;
      color: var(--slate-400);
      position: relative;
      transition: color .15s ease-in-out;
    }

    .chat-sidebar-menu>*>a:hover {
      color: var(--slate-600);
    }

    .chat-sidebar-menu>.active>a {
      box-shadow: inset 4px 0 0 0 var(--emerald-500);
      color: var(--emerald-600);
      background-color: var(--emerald-100);
    }

    .chat-sidebar-menu>*>a::before {
      content: attr(data-title);
      position: absolute;
      top: 50%;
      left: calc(100% - 16px);
      border-radius: 4px;
      transform: translateY(-50%);
      font-size: 13px;
      padding: 6px 12px;
      background-color: rgba(0, 0, 0, .6);
      color: var(--white);
      opacity: 0;
      visibility: hidden;
      transition: all .15s ease-in-out;
    }

    .chat-sidebar-menu>*>a:hover::before {
      left: calc(100% - 8px);
      opacity: 1;
      visibility: visible;
    }

    .chat-sidebar-profile {
      margin-top: auto;
      position: relative;
    }

    .chat-sidebar-profile-toggle {
      background-color: transparent;
      border: none;
      outline: transparent;
      width: 40px;
      height: 40px;
      margin: 0 auto;
      display: block;
      cursor: pointer;
    }

    .chat-sidebar-profile-toggle>img {
      object-fit: cover;
      width: 100%;
      height: 100%;
      border-radius: 50%;
    }

    .chat-sidebar-profile-dropdown {
      position: absolute;
      bottom: 100%;
      left: 16px;
      background-color: var(--white);
      box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
      list-style-type: none;
      border-radius: 4px;
      padding: 4px 0;
      opacity: 0;
      visibility: hidden;
      transform: scale(.9);
      transform-origin: left bottom;
      transition: all .15s ease-in-out;
    }

    .chat-sidebar-profile.active .chat-sidebar-profile-dropdown {
      opacity: 1;
      visibility: visible;
      transform: scale(1);
    }

    .chat-sidebar-profile-dropdown a {
      display: flex;
      align-items: center;
      padding: 8px 12px;
      text-decoration: none;
      color: var(--slate-400);
      font-size: 14px;
    }

    .chat-sidebar-profile-dropdown a:hover {
      background-color: var(--slate-100);
      color: var(--slate-600);
    }

    .chat-sidebar-profile-dropdown a:active {
      background-color: var(--slate-200);
    }

    .chat-sidebar-profile-dropdown a i {
      margin-right: 12px;
      font-size: 17px;
    }

    /* end: Sidebar */



    /* start: Content side */
    .chat-content {
      padding-left: 64px;
      height: 100%;
      position: relative;
    }

    .content-sidebar {
      width: 256px;
      background-color: var(--white);
      display: flex;
      flex-direction: column;
      height: 100%;
      position: absolute;
      top: 0;
      left: 64px;
    }

    .content-sidebar-title {
      font-size: 20px;
      font-weight: 600;
      padding: 16px;
    }

    .content-sidebar-form {
      position: relative;
      padding: 0 16px;
    }

    .content-sidebar-input {
      padding: 8px 16px;
      background-color: var(--slate-100);
      border: 1px solid var(--slate-300);
      outline: none;
      width: 100%;
      border-radius: 4px;
      padding-right: 32px;
      font-size: 14px;
    }

    .content-sidebar-input:focus {
      border-color: var(--slate-400);
    }

    .content-sidebar-submit {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      right: 32px;
      color: var(--slate-400);
      background-color: transparent;
      outline: transparent;
      border: none;
      cursor: pointer;
      transition: color .15s ease-in-out;
    }

    .content-sidebar-submit:hover {
      color: var(--slate-600);
    }

    .content-messages {
      overflow-y: auto;
      height: 100%;
      margin-top: 16px;
    }

    .content-messages-list {
      list-style-type: none;
      padding: 8px 0;
    }

    .content-messages-list>*>a {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: var(--slate-700);
      padding: 6px 16px;
    }

    .content-messages-list>*>a:hover {
      background-color: var(--slate-50);
    }

    .content-messages-list>.active>a {
      background-color: var(--slate-100);
    }

    .content-message-title {
      margin-left: 16px;
      margin-right: 16px;
      color: var(--slate-400);
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 2px;
      position: relative;
    }

    .content-message-title>* {
      position: relative;
      z-index: 1;
      padding: 0 4px 0 0;
      background-color: var(--white);
    }

    .content-message-title::before {
      content: '';
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 0;
      width: 100%;
      height: 0;
      border-bottom: 1px solid var(--slate-300);
      z-index: 0;
    }

    .content-message-image {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      object-fit: cover;
      flex-shrink: 0;
      margin-right: 12px;
    }

    .content-message-info {
      display: grid;
      margin-right: 12px;
      width: 100%;
    }

    .content-message-name {
      display: block;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 2px;
    }

    .content-message-text {
      font-size: 13px;
      color: var(--slate-400);
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
    }

    .content-message-more {
      text-align: right;
    }

    .content-message-unread {
      font-size: 12px;
      font-weight: 500;
      color: var(--white);
      background-color: var(--emerald-500);
      padding: 2px 4px;
      border-radius: 4px;
    }

    .content-message-time {
      font-size: 12px;
      color: var(--slate-400);
      font-weight: 500;
    }

    /* end: Content side */



    /* start: Conversation */
    .conversation {
      background-color: var(--slate-100);
      height: 100%;
      padding-left: 256px;
      display: none;
    }

    .conversation.active {
      display: flex;
      flex-direction: column;
    }

    .conversation-top {
      padding: 8px 16px;
      background-color: var(--white);
      display: flex;
      align-items: center;
    }

    .conversation-back {
      background-color: transparent;
      border: none;
      outline: none;
      width: 32px;
      height: 32px;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      cursor: pointer;
      color: var(--slate-400);
      margin-right: 12px;
      display: none;
    }

    .conversation-back:hover {
      background-color: var(--slate-100);
      border-radius: 50%;
      color: var(--slate-600);
    }

    .conversation-back:active {
      background-color: var(--slate-200);
    }

    .conversation-user {
      display: flex;
      align-items: center;
    }

    .conversation-user-image {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 8px;
    }

    .conversation-user-name {
      font-weight: 500;
      font-size: 17px;
    }

    .conversation-user-status {
      color: var(--slate-400);
      font-size: 13px;
    }

    .conversation-user-status::before {
      content: '';
      width: 10px;
      height: 10px;
      background-color: var(--slate-300);
      border-radius: 50%;
      vertical-align: middle;
      display: inline-block;
      margin-right: 4px;
    }

    .conversation-user-status.online::before {
      background-color: var(--emerald-500);
    }

    .conversation-buttons {
      display: flex;
      align-items: center;
      margin-left: auto;
    }

    .conversation-buttons>* {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
      font-size: 20px;
      background-color: transparent;
      border: none;
      outline: transparent;
      cursor: pointer;
      color: var(--slate-600);
      margin-left: 4px;
    }

    .conversation-buttons> :hover {
      background-color: var(--slate-100);
      color: var(--slate-700);
    }

    .conversation-buttons> :active {
      background-color: var(--slate-200);
    }

    .conversation-main {
      overflow-y: auto;
      overflow-x: hidden;
      height: 100%;
      padding: 16px;
    }

    .conversation-wrapper {
      list-style-type: none;
    }

    .conversation-item {
      display: flex;
      align-items: flex-end;
      flex-direction: row-reverse;
      margin-bottom: 16px;
    }

    .conversation-item.me {
      flex-direction: row;
    }

    .conversation-item-side {
      margin-left: 8px;
    }

    .conversation-item.me .conversation-item-side {
      margin-right: 8px;
    }

    .conversation-item-image {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      object-fit: cover;
      display: block;
    }

    .conversation-item-content {
      width: 100%;
    }

    .conversation-item-wrapper:not(:last-child) {
      margin-bottom: 8px;
    }

    .conversation-item-box {
      max-width: 720px;
      position: relative;
      margin-left: auto;
    }

    .conversation-item.me .conversation-item-box {
      margin-left: unset;
    }

    .conversation-item-text {
      padding: 12px 16px 8px;
      background-color: var(--white);
      box-shadow: 0 2px 12px -2px rgba(0, 0, 0, .1);
      font-size: 14px;
      border-radius: 6px;
      line-height: 1.5;
      margin-left: 32px;
    }

    .conversation-item.me .conversation-item-text {
      margin-left: unset;
      margin-right: 32px;
    }

    .conversation-item.me .conversation-item-text {
      background-color: var(--emerald-500);
      box-shadow: 0 2px 12px -2px var(--emerald-500);
      color: rgba(255, 255, 255, .8);
    }

    .conversation-item-time {
      font-size: 10px;
      color: var(--slate-400);
      display: block;
      text-align: right;
      margin-top: 4px;
      line-height: 1;
    }

    .conversation-item.me .conversation-item-time {
      color: rgba(255, 255, 255, .7);
    }

    .conversation-item-dropdown {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      visibility: hidden;
      transition: all .15s ease-in-out;
    }

    .conversation-item.me .conversation-item-dropdown {
      left: unset;
      right: 0;
    }

    .conversation-item-wrapper:hover .conversation-item-dropdown {
      opacity: 1;
      visibility: visible;
    }

    .conversation-item-dropdown-toggle {
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
      background-color: var(--white);
      outline: transparent;
      border: 1px solid var(--slate-200);
      cursor: pointer;
      transition: all .15s ease-in-out;
    }

    .conversation-item-dropdown-toggle:hover {
      background-color: var(--emerald-500);
      color: var(--white);
      box-shadow: 0 2px 12px -2px var(--emerald-500);
    }

    .conversation-item-dropdown-toggle:active {
      background-color: var(--emerald-600);
    }

    .conversation-item-dropdown-list {
      position: absolute;
      top: 100%;
      left: 0;
      background-color: var(--white);
      z-index: 10;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
      border-radius: 4px;
      padding: 4px 0;
      list-style-type: none;
      opacity: 0;
      visibility: hidden;
      transform: scale(.9);
      transform-origin: left top;
      transition: all .15s ease-in-out;
    }

    .conversation-item.me .conversation-item-dropdown-list {
      left: unset;
      right: 0;
    }

    .conversation-item-dropdown.active .conversation-item-dropdown-list {
      opacity: 1;
      visibility: visible;
      transform: scale(1);
    }

    .conversation-item-dropdown-list a {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: var(--slate-400);
      font-size: 13px;
      padding: 6px 12px;
    }

    .conversation-item-dropdown-list a:hover {
      background-color: var(--slate-100);
      color: var(--slate-600);
    }

    .conversation-item-dropdown-list a:active {
      background-color: var(--slate-200);
    }

    .conversation-item-dropdown-list a i {
      font-size: 16px;
      margin-right: 8px;
    }

    .coversation-divider {
      text-align: center;
      font-size: 13px;
      color: var(--slate-400);
      margin-bottom: 16px;
      position: relative;
    }

    .coversation-divider::before {
      content: '';
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 0;
      width: 100%;
      height: 0;
      border-bottom: 1px solid var(--slate-300);
    }

    .coversation-divider span {
      display: inline-block;
      padding: 0 8px;
      background-color: var(--slate-100);
      position: relative;
      z-index: 1;
    }

    .conversation-form {
      padding: 8px 16px;
      background-color: var(--white);
      display: flex;
      align-items: flex-end;
    }

    .conversation-form-group {
      width: 100%;
      position: relative;
      margin-left: 16px;
      margin-right: 16px;
    }

    .conversation-form-input {
      background-color: var(--slate-100);
      border: 1px solid var(--slate-300);
      border-radius: 4px;
      outline: transparent;
      padding: 10px 32px 10px 16px;
      font: inherit;
      font-size: 14px;
      resize: none;
      width: 100%;
      display: block;
      line-height: 1.5;
      max-height: calc(20px + ((14px * 2) * 6));
    }

    .conversation-form-input:focus {
      border-color: var(--slate-400);
    }

    .conversation-form-record {
      position: absolute;
      bottom: 8px;
      right: 16px;
      font-size: 20px;
      color: var(--slate-400);
      background-color: transparent;
      border: none;
      outline: transparent;
      cursor: pointer;
    }

    .conversation-form-record:hover {
      color: var(--slate-600);
    }

    .conversation-form-button {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
      border: none;
      background-color: transparent;
      outline: transparent;
      font-size: 20px;
      color: var(--slate-400);
      cursor: pointer;
      flex-shrink: 0;
    }

    .conversation-form-button:hover {
      background-color: var(--slate-100);
      color: var(--slate-600);
    }

    .conversation-form-button:active {
      background-color: var(--slate-200);
      color: var(--slate-600);
    }

    .conversation-form-submit {
      background-color: var(--emerald-500);
      box-shadow: 0 2px 8px -2px var(--emerald-500);
      color: var(--white);
    }

    .conversation-form-submit:hover {
      background-color: var(--emerald-600);
      color: var(--white);
    }

    .conversation-form-submit:active {
      background-color: var(--emerald-700);
      color: var(--white);
    }

    .conversation-default {
      align-items: center;
      justify-content: center;
      padding: 16px;
      padding-left: calc(256px + 16px);
      color: var(--slate-400);
    }

    .conversation-default i {
      font-size: 32px;
    }

    .conversation-default p {
      margin-top: 16px;
    }

    /* end: Conversation */



    /* start: Breakpoints */
    @media screen and (max-width: 1600px) {
      .chat-container {
        max-width: unset;
        height: 100vh;
      }
    }

    @media screen and (max-width: 767px) {
      .chat-sidebar {
        top: unset;
        bottom: 0;
        width: 100%;
        height: 48px;
      }

      .chat-sidebar-logo {
        display: none;
      }

      .chat-sidebar-menu {
        flex-direction: row;
        padding: 0;
      }

      .chat-sidebar-menu>*,
      .chat-sidebar-menu>*>a {
        width: 100%;
        height: 100%;
      }

      .chat-sidebar-menu>*>a {
        padding: 8px;
      }

      .chat-sidebar-menu>.active>a {
        box-shadow: inset 0 4px 0 0 var(--emerald-500);
      }

      .chat-sidebar-profile {
        margin-top: 0;
        display: flex;
        align-items: center;
      }

      .chat-sidebar-profile-toggle {
        width: 32px;
        height: 32px;
      }

      .chat-sidebar-profile-dropdown {
        left: unset;
        right: 16px;
      }

      .conversation,
      .chat-content {
        padding-left: unset;
      }

      .content-sidebar {
        left: unset;
        z-index: 10;
        width: 100%;
      }

      .chat-sidebar-menu>*>a::before {
        left: 50%;
        transform: translateX(-50%);
        bottom: 100%;
        top: unset;
      }

      .chat-sidebar-menu>*>a:hover::before {
        bottom: calc(100% + 8px);
        left: 50%;
      }

      .chat-content {
        position: relative;
        height: calc(100% - 48px);
      }

      .conversation.active {
        position: relative;
        z-index: 20;
      }

      .conversation-back {
        display: flex;
      }

      .conversation-default.active {
        display: none;
        padding: 16px;
      }
    }

    /* end: Breakpoints */
  </style>

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      // Function to send message
      function sendMessage() {
        var message = $('.conversation-form-input').val(); // Get the input value
        if (message.trim() !== '') { // Check if the message is not just whitespace
          $.ajax({
            url: '../App/Logic/update_chat.php', // The server-side script to process the request
            type: 'POST',
            data: {
              message: message
            },
            success: function(response) {
              console.log('Chat updated successfully');
              $('.conversation-form-input').val(''); // Clear the input field
            },
            error: function(xhr, status, error) {
              console.log('Error updating chat');
            }
          });
        }
      }

      // Trigger sendMessage when the submit button is clicked
      $('.conversation-form-submit').click(function() {
        sendMessage();
      });

      // Trigger sendMessage when Enter is pressed, but prevent form submission
      $('.conversation-form-input').keypress(function(e) {
        if (e.which == 13) { // Check if the pressed key is Enter (key code 13)
          e.preventDefault(); // Prevent the default action (form submission)
          sendMessage();
        }
      });
    });
  </script>

</head>

<body class="  ">
  <!-- loader Start -->
  <?php
  // include("./Public/Pages/Common/loader.php");

  ?>
  <!-- loader END -->

  <!-- sidebar  -->
  <?php
  include("./Public/Pages/Common/sidebar.php");

  ?>

  <main class="main-content">
    <?php
    include("./Public/Pages/Common/main_content.php");
    ?>


    <div class="content-inner container-fluid pb-0" id="page_layout">



      <section class="chat-section">
        <div class="chat-container">
          <!-- start: Sidebar -->
          <aside class="chat-sidebar">
            <a href="#" class="chat-sidebar-logo">
              <i class="ri-chat-1-fill"></i>
            </a>
            <ul class="chat-sidebar-menu">
              <li class="active"><a href="#" data-title="Chats"><i class="ri-chat-3-line"></i></a></li>
              <li><a href="#" data-title="Contacts"><i class="ri-contacts-line"></i></a></li>
              <li><a href="#" data-title="Documents"><i class="ri-folder-line"></i></a></li>
              <li><a href="#" data-title="Settings"><i class="ri-settings-line"></i></a></li>
              <li class="chat-sidebar-profile">
                <button type="button" class="chat-sidebar-profile-toggle">
                  <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                </button>
                <ul class="chat-sidebar-profile-dropdown">
                  <li><a href="#"><i class="ri-user-line"></i> Profile</a></li>
                  <li><a href="#"><i class="ri-logout-box-line"></i> Logout</a></li>
                </ul>
              </li>
            </ul>
          </aside>
          <!-- end: Sidebar -->
          <!-- start: Content -->
          <div class="chat-content">
            <!-- start: Content side -->
            <div class="content-sidebar">
              <div class="content-sidebar-title">Chats</div>
              <form action="" class="content-sidebar-form">
                <input type="search" class="content-sidebar-input" placeholder="Search...">
                <button type="submit" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
              </form>
              <div class="content-messages">
                <ul class="content-messages-list">
                  <li class="content-message-title"><span>Recently</span></li>
                  <li>
                    <a href="#" data-conversation="#conversation-1">
                      <img class="content-message-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                      <span class="content-message-info">
                        <span class="content-message-name">Someone</span>
                        <span class="content-message-text">Lorem ipsum dolor sit amet consectetur.</span>
                      </span>
                      <span class="content-message-more">
                        <span class="content-message-unread">5</span>
                        <span class="content-message-time">12:30</span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="#" data-conversation="#conversation-2">
                      <img class="content-message-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                      <span class="content-message-info">
                        <span class="content-message-name">Someone</span>
                        <span class="content-message-text">Lorem ipsum dolor sit amet consectetur.</span>
                      </span>
                      <span class="content-message-more">
                        <span class="content-message-time">12:30</span>
                      </span>
                    </a>
                  </li>

                </ul>

              </div>
            </div>
            <!-- end: Content side -->


            <!-- start: Conversation -->
            <div class="conversation conversation-default active">
              <i class="ri-chat-3-line"></i>
              <p>Select chat and view conversation!</p>
            </div>



            <div class="conversation" id="conversation-1">
              <div class="conversation-top">
                <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                <div class="conversation-user">
                  <img class="conversation-user-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                  <div>
                    <div class="conversation-user-name">Someone</div>
                    <div class="conversation-user-status online">online</div>
                  </div>
                </div>
                <div class="conversation-buttons">
                  <button type="button"><i class="ri-phone-fill"></i></button>
                  <button type="button"><i class="ri-vidicon-line"></i></button>
                  <button type="button"><i class="ri-information-line"></i></button>
                </div>
              </div>
              <div class="conversation-main">
                <ul class="conversation-wrapper">
                  <div class="coversation-divider"><span>Today</span></div>
                  <li class="conversation-item me">
                    <div class="conversation-item-side">
                      <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                    </div>
                    <div class="conversation-item-content">
                      <div class="conversation-item-wrapper">
                        <div class="conversation-item-box">
                          <div class="conversation-item-text">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet natus repudiandae quisquam sequi nobis suscipit consequatur rerum alias odio repellat!</p>
                            <div class="conversation-item-time">12:30</div>
                          </div>
                          <div class="conversation-item-dropdown">
                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                            <ul class="conversation-item-dropdown-list">
                              <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                              <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="conversation-item-wrapper">
                        <div class="conversation-item-box">
                          <div class="conversation-item-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, tenetur!</p>
                            <div class="conversation-item-time">12:30</div>
                          </div>
                          <div class="conversation-item-dropdown">
                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                            <ul class="conversation-item-dropdown-list">
                              <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                              <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="conversation-item">
                    <div class="conversation-item-side">
                      <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                    </div>
                    <div class="conversation-item-content">
                      <div class="conversation-item-wrapper">
                        <div class="conversation-item-box">
                          <div class="conversation-item-text">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <div class="conversation-item-time">12:30</div>
                          </div>
                          <div class="conversation-item-dropdown">
                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                            <ul class="conversation-item-dropdown-list">
                              <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                              <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      <div class="conversation-item-wrapper">
                        <div class="conversation-item-box">
                          <div class="conversation-item-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, debitis. Iste natus est aliquam ipsum doloremque fugiat, quidem eos autem? Dolor quisquam laboriosam enim cum laborum suscipit perferendis adipisci praesentium.</p>
                            <div class="conversation-item-time">12:30</div>
                          </div>
                          <div class="conversation-item-dropdown">
                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                            <ul class="conversation-item-dropdown-list">
                              <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                              <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                </ul>
              </div>



              <div class="conversation-form">


                <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                <div class="conversation-form-group">
                  <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>
                  <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
                </div>
                <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>



              </div>

            </div>





            <!-- end: Conversation -->




          </div>
          <!-- end: Content -->
        </div>
      </section>



    </div>





    <?
    include("./Public/Pages/Common/footer.php");
    // print_r($_SESSION);
    ?>

  </main>
  <!-- Wrapper End-->
  <!-- Live Customizer start -->
  <!-- Setting offcanvas start here -->
  <?php
  include("./Public/Pages/Common/theme_custom.php");

  ?>

  <!-- Settings sidebar end here -->

  <?php
  include("./Public/Pages/Common/settings_link.php");

  ?>
  <!-- Live Customizer end -->

  <!-- Library Bundle Script -->
  <?php
  include("./Public/Pages/Common/scripts.php");

  ?>
  <script>
    // start: Sidebar
    document.querySelector('.chat-sidebar-profile-toggle').addEventListener('click', function(e) {
      e.preventDefault()
      this.parentElement.classList.toggle('active')
    })

    document.addEventListener('click', function(e) {
      if (!e.target.matches('.chat-sidebar-profile, .chat-sidebar-profile *')) {
        document.querySelector('.chat-sidebar-profile').classList.remove('active')
      }
    })
    // end: Sidebar



    // start: Coversation
    document.querySelectorAll('.conversation-item-dropdown-toggle').forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.preventDefault()
        if (this.parentElement.classList.contains('active')) {
          this.parentElement.classList.remove('active')
        } else {
          document.querySelectorAll('.conversation-item-dropdown').forEach(function(i) {
            i.classList.remove('active')
          })
          this.parentElement.classList.add('active')
        }
      })
    })

    document.addEventListener('click', function(e) {
      if (!e.target.matches('.conversation-item-dropdown, .conversation-item-dropdown *')) {
        document.querySelectorAll('.conversation-item-dropdown').forEach(function(i) {
          i.classList.remove('active')
        })
      }
    })

    document.querySelectorAll('.conversation-form-input').forEach(function(item) {
      item.addEventListener('input', function() {
        this.rows = this.value.split('\n').length
      })
    })

    document.querySelectorAll('[data-conversation]').forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.preventDefault()
        document.querySelectorAll('.conversation').forEach(function(i) {
          i.classList.remove('active')
        })
        document.querySelector(this.dataset.conversation).classList.add('active')
      })
    })

    document.querySelectorAll('.conversation-back').forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.preventDefault()
        this.closest('.conversation').classList.remove('active')
        document.querySelector('.conversation-default').classList.add('active')
      })
    })
    // end: Coversation



    const gridElement = document.getElementsByClassName("chat-container")[0];
    const conversations = document.getElementsByClassName("conversations")[0];
    const backButton = document.getElementById("back-button");
    const conversationsModeClass = "conversations-mode";
    const messagesModeClass = "messages-mode";

    conversations.addEventListener("click", () => {
      gridElement.classList.remove(conversationsModeClass);
      gridElement.classList.add(messagesModeClass);
    });

    backButton.addEventListener("click", () => {
      gridElement.classList.remove(messagesModeClass);
      gridElement.classList.add(conversationsModeClass);
    });
  </script>

</body>

</html>