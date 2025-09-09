# TODO: Show Score Feature in Teacher Account

## Tasks
- [x] Modify index_teacher.blade.php to display the "Performa" column for teacher role
- [x] Ensure only the logged-in teacher's score is shown in their account
- [ ] Test the changes by logging in as a teacher user

## Details
- Added the "Performa" column to the teacher list table for guru role
- The score is calculated in TeacherController and displayed only for the logged-in teacher
- Actions column remains hidden for guru role to prevent unauthorized edits
