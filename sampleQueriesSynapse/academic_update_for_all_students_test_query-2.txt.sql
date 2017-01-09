SELECT ops.organization_id as org, ops.person_id as student_id,
p.lastname as lastname, ocs.org_courses_id  as course_id
FROM synapse.org_person_student ops 
JOIN synapse.person p on ops.person_id=p.id 
JOIN synapse.org_course_student ocs on ops.person_id=ocs.person_id
JOIN synapse.org_academic_terms oat on oat.organization_id=ops.organization_id
WHERE ops.organization_id=14 AND ops.person_id BETWEEN 997599 AND 4704495;