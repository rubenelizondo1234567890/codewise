SELECT ops.organization_id as org, ops.person_id as student_id,
p.lastname as lastname, ocs.org_courses_id  as course_id, ocf.person_id as faculty_id
FROM synapse.org_person_student ops 
JOIN synapse.person p on ops.person_id=p.id 
JOIN synapse.org_course_student ocs on ops.person_id=ocs.person_id
JOIN synapse.org_course_faculty ocf on ocs.org_courses_id=ocf.org_courses_id
JOIN synapse.org_academic_terms oat on oat.organization_id=ops.organization_id
WHERE ops.person_id=4703587 AND oat.start_date<='2015-10-22' AND oat.end_date>='2015-10-22';