SELECT ocs.org_courses_id, ocs.person_id
FROM synapse.org_course_student ocs 
JOIN synapse.org_academic_terms oat on oat.organization_id=ocs.organization_id
JOIN synapse.org_academic_year oay on oay.organization_id=ocs.organization_id
WHERE ocs.organization_id=58 
AND CURDATE() BETWEEN oat.start_date AND oat.end_date
AND CURDATE() BETWEEN oay.start_date AND oay.end_date
;

SELECT count(ocs.id)
FROM synapse.org_course_student ocs 
JOIN synapse.org_course_faculty ocf on ocf.organization_id=ocs.organization_id
JOIN synapse.org_permissionset ops on ocf.org_permissionset_id=ops.id
JOIN synapse.org_academic_terms oat on oat.organization_id=ocs.organization_id
JOIN synapse.org_academic_year oay on oay.organization_id=ocs.organization_id
WHERE ocs.organization_id=58
AND ops.create_view_academic_update=1 
AND CURDATE() BETWEEN oat.start_date AND oat.end_date
AND CURDATE() BETWEEN oay.start_date AND oay.end_date
group by ocs.org_courses_id
;