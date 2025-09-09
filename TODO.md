# TODO: Filter Teacher List for Guru Role

## Tasks
- [x] Modify TeacherController@index method to filter teachers based on user role
- [ ] Test the changes by logging in as different user types

## Details
- For users with role 'guru', only show their own teacher record
- For other roles (admin, evaluator), show all teachers as before
- No changes needed in the view file
