SELECT DISTINCT ocs.org_courses_id  as courseId, ocs.organization_id as org, ocs.person_id as student_id
FROM synapse.org_course_student ocs 
JOIN synapse.org_academic_terms oat on oat.organization_id=ocs.organization_id
JOIN synapse.org_academic_year oay on oay.organization_id=ocs.organization_id
LEFT JOIN synapse.org_courses oc on ocs.org_courses_id=oc.id
WHERE ocs.organization_id=58
AND CURDATE() BETWEEN oat.start_date AND oat.end_date
AND CURDATE() BETWEEN oay.start_date AND oay.end_date;